<?php

namespace App\Http\Controllers;

use App\Modeles\LikeComment;
use App\Modeles\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
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
}
