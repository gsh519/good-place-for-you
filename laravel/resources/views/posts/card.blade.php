<div class="card col-md-3 my-4 ripple">
  <div class="wrapper">
    <a href="{{ route('posts.show', ['post' => $post]) }}">
      <div>
        <img alt="example" class="img-fluid rounded" src="https://mdbootstrap.com/img/new/standard/city/043.jpg" />
      </div>
      <div class="wrap">
        <h5 class="card-text">{{ $post->place_name }}</h5>
        <p class="card-text">{{ $post->good_point }}</p>
        <div class="flex">
          <p class="card-text small">{{ $post->user->name }}</p>
          <p class="card-text">
            <post-like :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))' :initial-count-likes='@json($post->count_likes)' :authorized='@json(Auth::check())' endpoint="{{ route('posts.like', ['post' => $post]) }}">
            </post-like>
          </p>
        </div>
        @foreach($post->tags as $tag)
        @if($loop->first)
        <div class="card-text line-height">
          @endif
          <a href="{{ route('tags.show', ['tag_name' => $tag->tag_name]) }}" class="border p-1 mr-1 mt-1 text-muted">
            {{ $tag->hashtag }}
          </a>
          @if($loop->last)
        </div>
        @endif
        @endforeach
      </div>
    </a>

    @if( Auth::id() === $post->user_id )
    <!-- dropdown -->
    <div class="drop">
      <div class="dropdown">
        <a data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <button type="button" class="btn btn-link text-muted m-0 p-2">
            <i class="fas fa-ellipsis-v"></i>
          </button>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ route("posts.edit", ['post' => $post]) }}">
            <i class="fas fa-pen mr-1"></i>記事を更新する
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" data-mdb-toggle="modal" data-mdb-target="#modal-delete-{{ $post->id }}">
            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
          </a>
        </div>
      </div>
    </div>
    <!-- dropdown -->

    <!-- modal -->
    <div id="modal-delete-{{ $post->id }}" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-mdb-dismiss="modal" aria-label="閉じる">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
            @csrf
            @method('DELETE')
            <div class="modal-body">
              この投稿を削除します。よろしいですか？
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
  </div>
</div>
