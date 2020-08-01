@if(!$publication->likedByUser())
    <button id="yeahButtonPub{{$publication->id}}" class="btn btn-outline-success" onclick="likePublication({{$publication->id}})">
        <span id="yeahLabelPub{{$publication->id}}">Yeah</span>&nbsp<i class="far fa-thumbs-up" id="yeahIconPub{{$publication->id}}"></i>
        (<span id="yeahCountPub{{$publication->id}}">{{sizeof($publication->likes)}}</span>)
        <input id="routeLikePub{{$publication->id}}" type="hidden" value="{{route('publication.like', $publication->id)}}">
    </button>
@else
    <button id="yeahButtonPub{{$publication->id}}" class="btn btn-success" onclick="dislikePublication({{$publication->id}})">
        <span id="yeahLabelPub{{$publication->id}}">Yeah!</span>&nbsp<i class="fas fa-thumbs-up" id="yeahIconPub{{$publication->id}}"></i>
        (<span id="yeahCountPub{{$publication->id}}">{{sizeof($publication->likes)}}</span>)
        <input id="routeLikePub{{$publication->id}}" type="hidden" value="{{route('publication.like', $publication->id)}}">
    </button>
@endif
