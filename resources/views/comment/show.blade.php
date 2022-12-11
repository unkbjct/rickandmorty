<li data-id="{{$comment->id}}" class="comment-item border rounded shadow-sm d-flex align-items-center p-3 mb-3">
    <div class="comment-photo">
        <img class="img-thumbnail" src="{{$comment->img}}" alt="">
    </div>
    <div class="comment-info px-3">
        <div class="comment-name-date d-flex justify-content-between mb-2">
            <div class="comment-name">{{$comment->name}} @if($comment->parent_id) → {{$comment->parent_name}} @endif</div>
            <div class="comment-date">{{$comment->dateAsCarbon->diffForHumans()}}</div>
        </div>
        <div class="d-flex justify-content-between ">
            <div class="comment-message">{{$comment->message}}</div>
            <button class="btn-answer btn btn-outline-success btn-sm hidden">Ответить</button>
        </div>
    </div>
</li>
<ul class="comments_list__children">
    @each('comment.show', $comment->children, 'comment')
  </ul>