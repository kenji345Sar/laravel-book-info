@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row justify-content-center">
    @foreach($reviews as $review)

    <div class="col-md-4">
        <div class="card mb50">

          @include('reviews.modifydel')
          <div class="card-body">
                @if(!empty($review->image))
                    <div class='image-wrapper'><img class='book-image' src="{{ asset('storage/images/'.$review->image) }}"></div>
                @else
                    <div class='image-wrapper'><img class='book-image' src="{{ asset('images/dummy.png') }}"></div>
                @endif

                <h3 class='h3 book-title'>{{ $review->title }}</h3>

                <p class='description'>
                {!! nl2br(e( $review->body )) !!}
                </p>
                <div class="card-body pt-0 pb-2 pl-3">
                    <div class="card-text">
                    <review-like>
                    </review-like>
                    </div>
                </div>
                <a href="{{ route('reviews.show', ['review' => $review]) }}" class='btn btn-secondary detail-btn'>詳細を読む</a>
          </div>
        </div>
    </div>
    @endforeach

</div>
{{ $reviews->links() }}

@endsection
