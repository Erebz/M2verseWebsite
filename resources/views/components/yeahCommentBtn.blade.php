@if(!$comment->likedByUser())
<button id="yeahButtonCom{{$comment->id}}" class="btn btn-outline-success" onclick="likeComment({{$comment->id}})">
    <span id="yeahLabelCom{{$comment->id}}">Yeah</span>&nbsp<i class="far fa-thumbs-up" id="yeahIconCom{{$comment->id}}"></i>
    (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
    <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
</button>
@else
<button id="yeahButtonCom{{$comment->id}}" class="btn btn-success" onclick="dislikeComment({{$comment->id}})">
    <span id="yeahLabelCom{{$comment->id}}">Yeah!</span>&nbsp<i class="fas fa-thumbs-up" id="yeahIconCom{{$comment->id}}"></i>
    (<span id="yeahCountCom{{$comment->id}}">{{sizeof($comment->likes)}}</span>)
    <input id="routeLikeCom{{$comment->id}}" type="hidden" value="{{route('comment.like', $comment->id)}}">
</button>
@endif
