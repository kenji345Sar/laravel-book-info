@extends('layouts.app')

@section('content')
<h1 class='pagetitle'>レビュー投稿ページ</h1>
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
      <form method='POST' action="{{ route('reviews.store') }}" enctype="multipart/form-data">
      @include('reviews.form')
      <input type='submit' class='btn btn-primary' value='レビューを登録'>

      </form>
    </div>
</div>
@endsection
