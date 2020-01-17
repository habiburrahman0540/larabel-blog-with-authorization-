@extends('layouts.backend.app')
@section('title','Admin Dashboard')
@push('css')

@endpush
@section('content')
<div class="container-fluid">
            <div class="block-header">
                <h2>ADMIN DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Posts</div>
                            <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Favorite</div>
                            <div class="number count-to" data-from="0" data-to="{{Auth::user()->favorite_posts->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Pending Post</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_pending_post}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Views</div>
                            <div class="number count-to" data-from="0" data-to="{{$all_views}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">apps</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Category</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_categories}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">filter_vintage</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Tag</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_tag}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
               
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Author</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_author_count}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->



            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>5 Popular Posts</h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Rank List</th>
                                            <th>Title</th>
                                            <th>View</th>
                                            <th>Favorite</th>
                                            <th>Comments</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($popular_post as $key=>$post)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{str_limit($post->title,30)}}</td>
                                            <td><span class="label bg-green">{{$post->view_count}}</span></td>
                                            <td><span class="label bg-green">{{$post->favorite_to_user_count}}</span></td>
                                            <td><span class="label bg-green">{{$post->comments_count}}</span></td>
                                            @if($post->status == true)
                                            <td><span class="label bg-green">Published</span></td>
                                           @else
                                           <td><span class="label bg-red">Pending</span></td>
                                           @endif
                                            <td>
                                               <a class="btn btn-sm btn-primary waves-efect" target="_blank" href="{{route('post.details',$post->slug)}}">View</a>
                                            </td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
               
            </div>
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>10 Active Author</h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Rank List</th>
                                            <th>Name</th>
                                            <th>Posts</th>
                                            
                                            <th>Comments</th>
                                            <th>Favorite</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($total_active_author as $key=>$author)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$author->name}}</td>
                                            <td><span class="label bg-green">{{$author->posts_count}}</span></td>
                                            <td><span class="label bg-green">{{$author->comments_count}}</span></td>
                                            <td><span class="label bg-green">{{$author->favorite_posts_count}}</span></td>
                                           
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
               
            </div>
        </div>
  
@endsection
@push('js')

@endpush