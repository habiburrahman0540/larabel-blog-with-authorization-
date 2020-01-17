<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;


class CommentController extends Controller
{
    public function store(Request $request ,$post){
        $this->validate($request,[
            'comment'=>'required'
        ]);
    $comments = new Comment();
    $comments->post_id = $post;
    $comments->user_id = Auth::id();
    $comments->comment = $request->comment;
    $comments->save();
    return redirect()->back()->with('successMsg','Comment posted successfully.');
    }
    
}
