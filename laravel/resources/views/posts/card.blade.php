<div class="card col-md-3 mt-4 mb-4 p-0">
  <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
    <img src="https://mdbootstrap.com/img/new/standard/nature/111.jpg" class="img-fluid" />
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>

  {{-- ここから追加 --}}
  @if( Auth::id() === $post->user_id )
  <!-- dropdown -->
  <div class="ml-auto card-text">
    <div class="dropdown">
      <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <button type="button" class="btn btn-link text-muted m-0 p-2">
          <i class="fas fa-ellipsis-v"></i>
        </button>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="{{ route("posts.edit", ['post' => $post]) }}">
          <i class="fas fa-pen mr-1"></i>記事を更新する
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $post->id }}">
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
          <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
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
  {{-- ここまで追加 --}}

  <a href="{{ route('posts.show', ['post' => $post]) }}" class="card-body">
    <h5 class="card-title">{{ $post->place_name }}</h5>
    <h5 class="card-title">
      {{ $post->good_point }}
    </h5>
    <p class="card-text">
      {{ $post->user->name }}
    </p>
    <p class="card-text">
      {{ $post->created_at }}
    </p>
  </a>
</div>
