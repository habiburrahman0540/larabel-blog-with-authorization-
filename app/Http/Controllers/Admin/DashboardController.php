<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
       $posts = Post::all();
       $popular_post = Post::withCount('comments')
                        ->withCount('favorite_to_user')
                        ->orderBy('view_count','desc')
                        ->orderBy('comments_count','desc')
                        ->orderBy('favorite_to_user_count','desc')
                        ->take(5)
                        ->get();
    $total_pending_post = Post::where('is_approved',0)->count();
    $all_views = Post::sum('view_count');
    $total_author_count = User::where('role_id',2)->count();
    $new_author_today = User::where('role_id',2)
                            ->whereDate('created_at',Carbon::today())
                            ->count();
    $total_active_author = User::where('role_id',2)
                            ->withCount('posts')
                            ->withCount('comments')
                            ->withCount('favorite_posts')
                            ->orderBy('posts_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favorite_posts_count','desc')
                            ->take(10)
                            ->get();
    $total_categories = category::all()->count();
    $total_tag = Tag::all()->count();
       return view('admin.dashboard',compact('posts','popular_post','total_pending_post','all_views','total_author_count',
       'new_author_today','total_active_author','total_categories','total_tag'));
   }
}
