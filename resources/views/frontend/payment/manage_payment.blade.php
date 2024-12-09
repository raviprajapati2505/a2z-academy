@extends('layouts.app_front')

@section('content')
<div class="container">
  <div class="myactpagedatacov">
    <div class="myactpagedata_title">
      <h1>Manage Payment</h1>
      <p>Welcome to Manage Payment</p>
    </div>
    @if($errors->any())
    <div class="alert alert-danger mb-0" role="alert">
      {{$errors->first()}}
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
      {{ session()->get('success') }}
    </div>
    @endif
    <br>
    <div class="fullpageinerdata_cover">
      <div class="payhistdatacov1">
        <div class="fullpageinerdata_iner">
          <div class="fullpageinerdata_title">
            <h2>Courses</h2>
          </div>
          <div class="fullpageinerdata_tbl">
            <table id="paymenttbl" class="table display">
              <thead>
                <tr>
                  <th>Courses Detials</th>
                  <th>Total Price</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php $total = 0.00; ?>
                @if(count($pending_payment_course) > 0)
                @foreach($pending_payment_course as $course)
                <?php $total += $course->special_price ? $course->special_price : $course->price ?>
                <tr>
                  <td class="tblrowset1">
                    @if($course->cover_image)
                    <img src="<?= url('/') . '/public/' . $course->cover_image ?>">
                    @else
                    <!-- default image course -->
                    <img src="{{ asset('public/images/my-courses-img9.jpg') }}">
                    @endif
                    <span>{{ $course->name }}</span>
                  </td>
                  <td class="tblrowset2">${{ $course->special_price ? $course->special_price : $course->price }}</td>
                  <td class="tblrowset5">
                    <a href="{{ url('/remove_course_enroll') }}<?= '/' . $course->id ?>">
                      <img src="{{ asset('public/frontend/svg/close-icon.svg') }}" alt="">
                    </a>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td>No courses available</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="tabletotalprice">
            <p>Total Price <span>$<?= $total ?></span></p>
          </div>
        </div>
      </div>
      <div class="payhistdatacov2">
        <div class="payhistdatainer2">
          <div class="payhistdatainer_title">
            <h3>Summary</h3>
          </div>
          <div class="payhistdataicover_main">
            <!-- <div class="payhistdatainer_leftrig">
                            <div class="payhistdatainer_intblef">
                                <p>Total Courses</p>
                            </div>
                            <div class="payhistdatainer_intbrig">
                                <p>{{ count($pending_payment_course) }}</p>
                            </div>
                        </div>
                        <div class="payhistdatainer_leftrig">
                            <div class="payhistdatainer_intblef">
                                <p>Subtotal</p>
                            </div>
                            <div class="payhistdatainer_intbrig">
                                <p>$<?= $total ?></p>
                            </div>
                        </div> -->
            <!-- <div class="payhistdatainer_leftrig">
                            <div class="payhistdatainer_intblef">
                                <p>Discount for points</p>
                            </div>
                            <div class="payhistdatainer_intbrig">
                                <p>-$0</p>
                            </div>
                        </div> -->
            <!-- <div class="payhistdatainer_leftrig totaldatalistcov">
                            <div class="payhistdatainer_intblef">
                                <p>Total</p>
                            </div>
                            <div class="payhistdatainer_intbrig">
                                <p>$<?= $total ?></p>
                            </div>
                        </div> -->
            <h4><b>Note :</b> The payment gateway is currently under development. For any payment-related inquiries, please contact info@gord.qa .”</h3>
            <!-- <div class="paymecorcdatapric">
              <a href="{{ url('/pay_for_courses') }}" class="amount_to_be_paid">Proceed To Payment $<?= $total ?></a><br><br>
              <a href="{{ url('/pay_for_courses') }}" class="amount_to_be_paid">Hold Payment $<?= $total ?></a>
            </div>
            <div class="promocodepaymet">
              <a href="javascript:void(0);" class="promo_button">Promo code?</a>
            </div> -->
            <br>
            <div class="promo_form">
              <div class="row">
                <div class="col-md-8"> <input type="text" class="form-control" name="code" id="code" placeholder="Enter Promo Code"></div>
                <div class="col-md-4">
                  <a href="javascript:void(0);" class="apply_promo">
                    Apply</a>&nbsp;&nbsp;
                  <a href="javascript:void(0);" class="reset_promo">
                    Reset</a>
                </div>
                <p class="msg" style="color:green"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.promo_form').hide()
    $('.promo_button').click(function() {
      $('.promo_form').toggle()
    })
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    $('.apply_promo').click(function() {
      var store = <?php echo json_encode(route('apply_promo')) ?>;
      var total = '<?= $total ?>'
      $.ajax({
        data: {
          code: $('#code').val()
        },
        url: store,
        type: "POST",
        dataType: 'json',
        success: function(data) {
          if (data.success) {
            $('.msg').text(data.message);
            $('.msg').css('color', 'green');
            if (data.data[0].discount_type == 'Fixed Amount') {
              var final_amount = total - data.data[0].discount_amount;
            } else {
              var discount_amount = ((data.data[0].discount_amount / 100) * total).toFixed(2);
              var final_amount = total - discount_amount;
            }

            $('.amount_to_be_paid').text('Proceed To Payment $' + final_amount);
          } else if (data.message == 'Error validation') {
            for (var key in data.data) {
              var value = data.data[key];
              $('#alert-danger-form').text(value[0]);
            }
            $('.amount_to_be_paid').text('Proceed To Payment $' + total);
          } else {
            $('.msg').text(data.message);
            $('.msg').css('color', 'red');
            $('.amount_to_be_paid').text('Proceed To Payment $' + total);
          }
          setTimeout(function() {
            $('.msg').text('')
          }, 2000);
        },
        error: function(data) {
          console.log('Error:', data);
          $('#saveBtn').html('Save');
        }
      });
    });

    $('.reset_promo').click(function() {
      var total = '<?= $total ?>';
      $('.amount_to_be_paid').text('Proceed To Payment $' + total);
      $('#code').val('');
    })
  });
</script>
@endsection