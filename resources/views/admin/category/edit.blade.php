@extends('layouts.backend.app')
@section('title','Category create')
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
                                Edit Category
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
                            <form action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control">
                                        <label class="form-label">Category Name</label>
                                    </div>
                                </div>
                               
                                <div class="form-group form-float">
                                <input type="file" name="image" value="{{$category->image}}" id="image" >
                                    
                                </div>

                                <a href="{{route('admin.category.index')}}" class="btn btn-danger m-t-15 waves-effect">Back </a>
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