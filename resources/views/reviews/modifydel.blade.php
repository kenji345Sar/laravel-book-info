@if( Auth::id() === $review->user_id )
    <!-- dropdown -->
    <div class="ml-auto card-text">
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            変更&削除
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ route("reviews.edit", ['review' => $review]) }}">記事を更新する</a>
            <a class="dropdown-item" data-toggle="modal" data-target="#modal-delete-{{ $review->id }}">記事を削除する</a>
        </div>
    </div>
    </div>
    <!-- dropdown -->

    <!-- modal -->
    <div id="modal-delete-{{ $review->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form method="POST" action="{{ route('reviews.destroy', ['review' => $review]) }}">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                {{ $review->title }}を削除します。よろしいですか？
            </div>
            <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- modal -->
@endif

