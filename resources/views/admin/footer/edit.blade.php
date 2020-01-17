@extends('layouts.backend.app')
@section('title','Admin Dashboard')
@push('css')

@endpush
@section('content')

<div class="container-fluid">
            

           <!-- Vertical Layout | With Floating Label -->
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add New Tag
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
                            <form action="{{route('admin.tag.update',$tag->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="name" value="{{$tag->name}}" id="name" class="form-control">
                                        <label class="form-label">Tag Name</label>
                                    </div>
                                </div>

                                <a href="{{route('admin.tag.index')}}" class="btn btn-danger m-t-15 waves-effect">Back </a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
        
        </div>
  
@endsection
@push('js')
    
@endpush