<?php

namespace App\Http\Controllers;

use App\category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PostController extends Controller
{


public function index(){
$posts = Post::latest()->approved()->published()->paginate(6);
return view('posts',compact('posts'));

}
  public function details($slug){
        $posts = Post::where('slug',$slug)->approved()->published()->first();
        $blogkey = 'blog_'.$posts->id;
        if(!Session::has($blogkey)){
            $posts->increment('view_count');
            Session::put($blogkey,1);
        }
        $randonposts = Post::approved()->published()->take(3)->inRandomOrder(3)->get();
        return view('post',compact('posts','randonposts'));
    }
    public function postByCategory($slug){
        $category = category::where('slug',$slug)->first();
        $posts= $category->posts()->approved()->published()->get();
        return view('category',compact('category','posts'));
    }
    public function postByTag($slug){
        $tag = Tag::where('slug',$slug)->first();
        $posts= $tag->posts()->approved()->published()->get();
        return view('tag',compact('tag','posts'));
    }
}
