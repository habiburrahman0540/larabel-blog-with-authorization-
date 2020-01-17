@extends('layouts.frontend.app')
@section('title','login')
@push('css')
<link href="{{asset('public/assets/frontend/css/profile/styles.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/frontend/css/profile/responsive.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/frontend/css/ionicons.css')}}" rel="stylesheet">
<style>
.favorite_post{
	color: red
}
</style>
@endpush
@section('content')
    
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{ucfirst($author->username)}} Posts</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">
                    @foreach($posts as $post)
                    <div class="col-md-6 col-sm-12">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="Blog Image"></div>

							<a class="avatar" href="{{route('author.post.profile',$post->user->username)}}"><img src="{{Storage::disk('public')->url('profile/'.$post->user->image)}}"  alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

								<ul class="post-footer">
									<li>
									@guest
									<a  href="#" onclick="fav()"><i class="ion-heart"></i>{{$post->favorite_to_user->count()}}</a>
									@else
									<a  href="javascript::void(0)" onclick="document.getElementById('favorite-form-{{$post->id}}').submit();"
									class="{{! Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()==0 ? 'favorite_post': ''}}"
									><i class="ion-heart"></i>{{$post->favorite_to_user->count()}}</a>
						<form id="favorite-form-{{$post->id}}" action="{{route('post.favorite',$post->id)}}" method="POST" style="display: none;">
						@csrf


						</form>
									@endguest
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
@endforeach

					</div><!-- row -->

				

				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 ">

					<div class="single-post info-area ">

						<div class="about-area">
                            <h4 class="title"><b>{{ucfirst($author->username)}} Profile</b></h4>
                            <b>{{ucfirst($author->username)}} Name : {{$author->name}}</b> 
                            <p>About {{ucfirst($author->username)}} :{{$author->about}}</p></br>
                            <b>Total post : {{$author->posts->count()}}</b>
						</div>
					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->



@endsection
    @push('js')
    <script src="{{asset('public/assets/frontend/js/swiper.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script type="text/javascript">
 function fav(id){
    Swal.fire({
  title: 'To add as favorite list ,you should to login first.',
  showClass: {
    popup: 'animated fadeInDown faster'
  },
  hideClass: {
    popup: 'animated fadeOutUp faster'
  }
})
}
</script>
	
     @endpush