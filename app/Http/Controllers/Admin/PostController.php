<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Http\Controllers\Controller;
use App\Notifications\AuthorPostApprove;
use App\Post;
use App\Subscriber;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Notifications\NewPostNotify;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all();
        $tags = Tag::all();
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
        'title' => 'required',
        'image' => 'required',
        'body' => 'required',
        'status' => 'required',
        'categories' => 'required',
        'tags' => 'required',
       ]);
       $image = $request->file('image');
       $slug = str_slug($request->title);
       if(isset($image)){
       $currentdate = Carbon::now()->toDateString();
       $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
       if(!Storage::disk('public')->exists('post')){
            Storage::disk('public')->makeDirectory('post');
       }
       $post =Image::make($image)->resize(1600,1066)->stream();
       Storage::disk('public')->put('post/'. $imageName,$post);
   }
  

    else{
        $imageName ='default.png';
    }
    $post = new Post();
    $post->user_id = Auth::id();
    $post->title =$request->title;
    $post->slug =$slug;
    $post->image =$imageName;
    $post->body = $request->body;
    if(isset($request->status)){
        $post->status = true;
    }else{
        $post->status = false;
    }
    $post->is_approved = true;
    $post->save();
    $post->categories()->attach($request->categories);
    $post->tags()->attach($request->tags);
    $subscribers = Subscriber::all();
    foreach($subscribers as $subscriber){
        Notification::route('mail',$subscriber->email)->notify(new NewPostNotify($post));
    }
    return redirect(route('author.post.index'))->with('successMsg','Post added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = category::all();
        $tags = Tag::all();
        return view('admin.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            'body' => 'required',
            'status' => 'required',
            'categories' => 'required',
            'tags' => 'required',
           ]);
           $image = $request->file('image');
           $slug = str_slug($request->title);
           if(isset($image)){
           $currentdate = Carbon::now()->toDateString();
           $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
           if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
           }
           if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
       }
           $postImage =Image::make($image)->resize(1600,1066)->stream();
           Storage::disk('public')->put('post/'. $imageName,$postImage);
       }
      
    
        else{
            $imageName = $post->image;
        }
        
        $post->user_id = Auth::id();
        $post->title =$request->title;
        $post->slug =$slug;
        $post->image =$imageName;
        $post->body = $request->body;
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        return redirect(route('admin.post.index'))->with('successMsg','Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image)){
            Storage::disk('public')->delete('post/'.$post->image);
    }
    $post->categories()->detach();
    $post->tags()->detach();
    $post->delete();
    return redirect(route('admin.post.index'))->with('successMsg','Post Deleted successfully.');
}
public function pending()
    {
        $posts = Post::where('is_approved',false)->get();
    return view('admin.post.pending',compact('posts'));
}
public function authorpost()
    {
        $posts = Post::where('user_id',2)->get();
    return view('admin.post.authorpost',compact('posts'));
}
public function approval($id){
$post =Post::find($id);
if($post->is_approved == false){
    $post->is_approved = true;
    $post->save();
    $post->user->notify(new AuthorPostApprove($post));
    $subscribers = Subscriber::all();
    foreach($subscribers as $subscriber){
        Notification::route('mail',$subscriber->email)->notify(new NewPostNotify($post));
    }
    return redirect(route('admin.post.pending'))->with('successMsg','Post approved successfully.');
}else{
    return redirect(route('admin.post.pending'))->with('successMsg','Post already exist.');
}
}
public function unapproval($id){
    $post =Post::find($id);
    if($post->is_approved == true){
        $post->is_approved = false;
        $post->save();
        return redirect(route('admin.post.authorpost'))->with('successMsg','Post unapprove successfully.');
    }else{
        return redirect(route('admin.post.authorpost'))->with('successMsg','Post already exist.');
    }
    }

}