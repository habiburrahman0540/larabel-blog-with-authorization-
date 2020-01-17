<?php

namespace App\Http\Controllers\Admin;

use App\category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
           'name' => 'required|unique:categories',
           'image' => 'required|mimes:jpeg,png,jpg',
       ]);
       $image = $request->file('image');
       $slug = str_slug($request->name);
       if(isset($image)){
       $currentdate = Carbon::now()->toDateString();
       $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
       if(!Storage::disk('public')->exists('category')){
            Storage::disk('public')->makeDirectory('category');
       }
       $category =Image::make($image)->resize(1600,479)->stream();
       Storage::disk('public')->put('category/'. $imageName,$category);

       if(!Storage::disk('public')->exists('category/slider')){
        Storage::disk('public')->makeDirectory('category/slider');
   }
   $slider =Image::make($image)->resize(500,333)->stream();
   Storage::disk('public')->put('category/slider/'. $imageName,$slider);


    }else{
        $imageNamne ='default.png';
    }
    $Category = new category();
    $Category->name = $request->name;
    $Category->slug =$slug;
    $Category->image =$imageName;
    $Category->save();
    return redirect(route('admin.category.index'))->with('successMsg','Category added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $category = category::find($id);
        if(isset($image)){
        $currentdate = Carbon::now()->toDateString();
        $imageName = $slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        if(!Storage::disk('public')->exists('category')){
             Storage::disk('public')->makeDirectory('category');
        }
        if(Storage::disk('public')->exists('category/'.$category->image)){
            Storage::disk('public')->delete('category/'.$category->image);
        }
        $categoryimage =Image::make($image)->resize(1600,479)->stream();
        Storage::disk('public')->put('category/'. $imageName,$categoryimage);
 
        if(!Storage::disk('public')->exists('category/slider')){
         Storage::disk('public')->makeDirectory('category/slider');
    }
    if(Storage::disk('public')->exists('category/slider/'.$category->image)){
        Storage::disk('public')->delete('category/slider/'.$category->image);
    }
    $slider =Image::make($image)->resize(500,333)->stream();
    Storage::disk('public')->put('category/slider/'. $imageName,$slider);
 
 
     }else{
         $imageNamne ='default.png';
     }

     $category->name = $request->name;
     $category->slug =$slug;
     $category->image = $imageName;
     $category->save();
     return redirect(route('admin.category.index'))->with('successMsg','Category edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        category::find($id)->delete();
        return redirect(route('admin.category.index'))->with('successMsg','Category deleted successfully.');
    }
}
