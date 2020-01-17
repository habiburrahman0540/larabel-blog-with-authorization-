@extends('layouts.backend.app')
@section('title','User Settings')
@push('css')

@endpush
@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-xs-12 col-sm-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="{{Storage::disk('public')->url('profile/'.Auth::user()->image)}}" width="100" height="100" alt="">
                            </div>
                            <div class="content-area">
                                <h3>{{$user->name}}</h3>
                                <p>{{$user->username}}</p>
                                
                            </div>
                        </div>
                        <div class="profile-footer">
                            <ul>
                                <li>
                                    <span>Followers</span>
                                    <span>1.234</span>
                                </li>
                                <li>
                                    <span>Following</span>
                                    <span>1.201</span>
                                </li>
                                <li>
                                    <span>Friends</span>
                                    <span>14.252</span>
                                </li>
                            </ul>
                            <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button>
                        </div>
                    </div>

                    
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            
                        <div class="header">
                         <h2>ABOUT ME</h2>
                        </div>
                                    <div class="content">
                                       {{$user->about}}
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
  
@endsection
@push('js')
    
@endpush