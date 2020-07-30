<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Modeles\LikeComment;
use App\Modeles\Message;
use App\Modeles\Publication;
use App\Traits\CommentPost;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    use CommentPost;

    public function like(Message $comment){
        if(!$comment->likedByUser()){
            $user = Session::get('user');
            LikeComment::create([
                'utilisateur_id' => $user->id,
                'comment_id' => $comment->id,
            ]);
        }
        //return back()->send();
    }

    public function dislike(Message $comment){
        if($comment->likedByUser()){
            $user = Session::get('user');
            $like = LikeComment::where('utilisateur_id', $user->id)->where('comment_id', $comment->id);
            $like->delete();
        }
        //return back()->send();
    }

    public function store(CommentRequest $request, Publication $publication){
        //dd($request->image);
        $this->comment($request, $publication, Session::get('user'));
        return back()->send();
    }
}
