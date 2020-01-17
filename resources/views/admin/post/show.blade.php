@extends('layouts.backend.app')
@section('title','Add New Post')
@push('css')

@endpush
@section('content')

<div class="container-fluid">
<div class="block-header">
                
<a href="{{route('admin.post.index')}}" class="btn btn-danger m-t-15 waves-effect"><i class="material-icons">settings_backup_restore</i> 
               <span>Back</span> </a>

               @if($post->is_approved == false)
               <button type="button" class="btn btn-success pull-right"><i class="material-icons">done</i> 
               <span>Approve</span> </button>
               @else
               <button type="button" class="btn btn-success pull-right" disabled><i class="material-icons">done</i> 
               <span>Approved</span> </button>
               @endif
                
            </div>

           <!-- Vertical Layout | With Floating Label -->
           <div class="row clearfix">
               
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                           {{$post->title}}
                           <small>posted by <strong> <a href="">{{$post->user->name}}</a> </strong>on {{$post->created_at->toFormattedDateString() }} </small>
                            </h2>
                           
                        </div>
                        <div class="body">
                           {!! $post->body !!}
                                
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                           Categories
                            </h2>
                           
                        </div>
                        <div class="body">
                        @foreach($post->categories as $category)
                                        <span class="lavel bg-cyan">{{$category->name}}</span>
                                        @endforeach
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                           Tags
                            </h2>
                           
                        </div>
                        <div class="body">
                        @foreach($post->tags as $tag)
                                        <span class="lavel bg-green">{{$tag->name}}</span>
                                        @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-amber">
                            <h2>
                          Feature Image
                            </h2>
                           
                        </div>
                        <div class="body">
                        <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" >
                        </div>
                    </div>
                </div>
            </div>
           
           
        </div>
  
@endsection
@push('js')


@endpush