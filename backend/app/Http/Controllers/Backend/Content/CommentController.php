<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest('id')->paginate(config('settings.paginate_per_page'));
		return view('backend.comments.index',[
			'comments'=>$comments,
		]);
    }

    public function show(Comment $comment)
    {
        return view('backend.comments.show',[
			'comment' => $comment,
		]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'comment ' . __('lang.successfully_deleted'));
    }
}
