@csrf
<div class="card">
    <div class="card-body">
        <div class="form-group">
        <label>本のタイトル</label>
        <input type="text" name="title" class="form-control" value="{{ $review->title ?? old('title') }}">
        </div>
        <div class="form-group">
          <review-tags-input
          :initial-tags='@json($tagNames ?? [])'
          :autocomplete-items='@json($allTagNames ?? [])'
    
          >
          </review-tags-input>
        </div>
        <div class="form-group">
        <label>レビュー本文</label>
        <textarea name="body" class="form-control" rows="16" >{{ $review->body ?? old('body') }}</textarea>

        </div>
        <div class="form-group">
        <label for="file1">本のサムネイル</label>
        <input type="file" id="file1" name='image' class="form-control-file">
        </div>
    </div>
</div>
<br>
