@extends('layouts.backend.app')
@section('title','Edit Post page')
@push('css')

@endpush
@section('content')

<div class="container-fluid">
            <form action="{{route('author.post.update',$post->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

           <!-- Vertical Layout | With Floating Label -->
           <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                            Edit Post
                                @if($errors->any())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger m-t-15" role="alert">
                                        {{$error}}
                                </div>
                                   
                                @endforeach
                                @endif
                            </h2>
                           
                        </div>
                        <div class="body">
                           
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
                                        <label class="form-label">Post Title</label>
                                    </div>
                                </div>
                               
                                <div class="form-group form-float">
                                <label for="image">Featured Image</label> 
                                <input type="file" name="image" id="image" >
                                    
                                </div>
                                <span>Enable status to publish post</span>
                                <div class="switch">
                                    <label><input type="checkbox" id="publish" name="status" value="1" {{$post->status == true ? 'checked' : '' }}><span class="lever"></span></label>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header">
                            <h2>
                           
                            </h2>
                           
                        </div>
                        <div class="body">
                           
                        <div class="form-group form-float">
                                    <div class="form-line {{$errors->has('categories') ? 'focused error': ''}}">
                                        
                                        <label for="category">Select Category</label>
                                        <select class="form-control show-tick" name="categories[]" id="category" multiple>
                                       @foreach($categories as $category)
                                        <option 
                                        @foreach($post->categories as $postCatagory)
                                            {{$postCatagory->id == $category->id ? 'selected' : ''}}
                                        @endforeach
                                        value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                <div class="form-line {{$errors->has('tags') ? 'focused error': ''}}">
                                        
                                        <label for="tag">Select Tag</label>
                                        <select class="form-control show-tick" name="tags[]" id="tag" multiple>
                                       @foreach($tags as $tag)
                                        <option 
                                        @foreach($post->tags as $posttag)
                                            {{$posttag->id == $tag->id ? 'selected': ''}}
                                        @endforeach
                                        value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            Post body
                            
                            </h2>
                           
                        </div>
                        <div class="body">
                        
                        
                        <textarea id="mceEditor"  cols="50" name="body" class="form-control editor" rows="10">{{$post->body}}</textarea>
                        <a href="{{route('author.post.index')}}" class="btn btn-danger m-t-15 waves-effect">Back </a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            
                    </div>
                       
                            
                    </div>
                </div>
            </div>
            </form>
        </div>
  
@endsection
@push('js')


@endpush