<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    use App\User;
class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $posts = $user->posts;
        $Total_pending_posts = $posts->where('is_approved',0)->count();
        $all_views =$posts->sum('view_count');
        $popular_posts = $user->posts()
                        ->withCount('comments')
                        ->withCount('favorite_to_user')
                        ->orderBy('view_count','desc')
                        ->orderBy('comments_count')
                        ->orderBy('favorite_to_user_count')
                        ->take(5)
                        ->get();
        return view('author.dashboard',compact('user','posts','Total_pending_posts','all_views','popular_posts'));
    }
}
