@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>レビュー変更ページ</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row justify-content-center container">
    <div class="col-md-10">
      <form method="POST" action="{{ route('reviews.update', ['review' => $review]) }}">
      @method('PATCH')

      @include('reviews.form')
      <input type='submit' class='btn btn-primary' value='レビューを修正'>

      </form>
    </div>
</div>
@endsection
