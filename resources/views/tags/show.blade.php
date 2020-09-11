@extends('layouts.app')

@section('title', $tag->hashtag)

@section('content')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->reviews->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->reviews as $review)

      <div class="card">
        @include('reviews.modifydel')
        <div class="card-body d-flex">
        <section class='review-main'>
            <h2 class='h2'>本のタイトル</h2>
            <p class='h2 mb20'>{{ $review->title }}</p>
            <h2 class='h2'>レビュー本文</h2>
            <p>{{ $review->body }}</p>
        </section>
        <aside class='review-image'>
            @if(!empty($review->image))
                <img class='book-image' src="{{ asset('storage/images/'.$review->image) }}">
            @else
                <img class='book-image' src="{{ asset('images/dummy.png') }}">
            @endif
        </aside>
        </div>
        <a href="{{ route('reviews.index') }}" class='btn btn-info btn-back mb20'>一覧へ戻る</a>
    </div>

    @endforeach
  </div>
@endsection
