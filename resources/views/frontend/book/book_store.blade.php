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
                <h5>By {{ $book->author }}</h5>
                <div class="book-readmorebtn">
                  @if($book->external_link)
                  <a href="<?= $book->external_link ?>" target="_blank">Read</a>
                  @else
                  <a href="<?= url('/') . '/public/' . $book->book_file ?>" target="_blank">Read</a>
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