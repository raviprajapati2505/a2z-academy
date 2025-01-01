@extends('layouts.app_front')

@section('content')
<div class="container bookreedstormaincov">
    <div class="classall-datacover">

        <div class="classalldatitand-cls">
            <div class="classalldata-title">
                <h3>Study Books</h3>
            </div>
            <!-- <div class="rightviewallbtnset">
        <a href="javascript:void(0);">View All</a>
      </div> -->
        </div>

        <div class="classalldata-inerbox">
            <div class="row">
                @if(count($books) > 0)
                @foreach($books as $book)
                <div class="classalldata-box3">
                    <div class="coursesdata-cover">
                        <div class="coursesdata-iner">
                            <div class="coursesdata-img">
                                @if($book->cover_image)
                                <img src="<?= url('/') . '/public/' . $book->cover_image ?>">
                                @else
                                <!-- default image book -->
                                <img src="{{ asset('public/frontend/images/book-img1.png') }}" alt="Allie Grater">
                                @endif
                            </div>
                            <div class="coursesdata-livetext">
                                <h3>{{ $book->name }}</h3>
                                <h5>By {{ $book->author }}</h5><br><br><br>
                                <div class="book-readmorebtn">
                                    @php
                                    $hasPaid = false; // Default value

                                    // Check if the user is authenticated
                                    if (Auth::check()) {
                                    $hasPaid = \App\Models\StudentBookHistory::where('student_id', Auth::id())
                                    ->where('book_id', $book->id)
                                    ->where('is_paid', 1)
                                    ->exists();
                                    }
                                    @endphp

                                    @if($hasPaid)
                                    <a style="width:100px" href="<?= $book->external_link ?>" target="_blank">View Book</a>
                                    <!-- <a style="width:90px" href="<?= $book->external_link ?>" target="_blank">Preview</a> -->
                                    @else
                                    <a style="width:100px" href="<?= route('pay_for_book', $book->id) ?>">Buy Now</a>
                                    <a style="width:90px" href="<?= url('/') . '/public/' . $book->book_file ?>" target="_blank">Preview</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>No books available</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection