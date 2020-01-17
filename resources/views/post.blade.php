@extends('layouts.frontend.app')
@section('title')
{{$posts->title}}
@endsection
@push('css')
<style>
.header-bg{
	height: 70%;
	width: 100%;
	background-image: url({{Storage::disk('public')->url('post/'.$posts->image)}});
	background-size:cover;
}
.favorite_post{
	color: red
}
</style>
<link href="{{asset('public/assets/frontend/css/styles.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/frontend/css/responsive.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/frontend/css/ionicons.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="header-bg">
		
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'.$posts->user->image)}}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{$posts->user->name}}</b></a>
									<h6 class="date">on {{$posts->updated_at->diffForHumans()}}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#"><b>{{$posts->title}}</b></a></h3>

							<p class="para">{!!html_entity_decode($posts->body) !!}</p>

							<ul class="tags">
								@foreach($posts->tags as $tag)
								<li><a href="{{route('tag.posts',$tag->slug)}}">{{$tag->name}}</a></li>
								@endforeach
							</ul>
						</div><!-- blog-post-inner -->


						<div class="post-icons-area">
						<ul class="post-icons">
									<li>
									@guest
									<a  href="#" onclick="fav()"><i class="ion-heart"></i>{{$posts->favorite_to_user->count()}}</a>
									@else
									<a  href="javascript::void(0)" onclick="document.getElementById('favorite-form-{{$posts->id}}').submit();"
									class="{{! Auth::user()->favorite_posts->where('pivot.post_id',$posts->id)->count()==0 ? 'favorite_post': ''}}"
									><i class="ion-heart"></i>{{$posts->favorite_to_user->count()}}</a>
<form id="favorite-form-{{$posts->id}}" action="{{route('post.favorite',$posts->id)}}" method="POST" style="display: none;">
@csrf


</form>
									@endguest
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>{{$posts->comments->count()}}</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{$posts->view_count}}</a></li>
								</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>



					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>About Author</b></h4>
							<p>{{$posts->user->about}}</p>
						</div>

						<div class="sidebar-area subscribe-area">

							<h4 class="title"><b>SUBSCRIBE</b></h4>
							@if(session('successMsg'))
                    <div class="alert alert-success m-t-15" role="alert">
                        {{session('successMsg')}}
                        @endif
                @if($errors->any())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger m-t-15" role="alert">
                                        {{$error}}
                                </div>
                                   
                                @endforeach
                                @endif
                <div class="input-area">
                    <form action="{{route('subscriber.store')}}" method="POST">
                        @csrf
                        <input class="email-input" type="email" name="email" id="email" placeholder="Enter your email">
                        <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                    </form>
                </div>

						</div><!-- subscribe-area -->

						<div class="tag-area">

							<h4 class="title"><b>Categories</b></h4>
							<ul>
								@foreach($posts->categories as $category)
								<li><a href="{{route('category.posts',$category->slug)}}">{{$category->name}}</a></li>
								@endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">
@foreach($randonposts as $randonpost)
				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$randonpost->image)}}" alt="Blog Image"></div>

							<a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'.$randonpost->user->image)}}" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{route('post.details',$randonpost->slug)}}"><b>{{$randonpost->title}}</b></a></h4>

								<ul class="post-footer">
									<li>
									@guest
									<a  href="#" onclick="fav()"><i class="ion-heart"></i>{{$randonpost->favorite_to_user->count()}}</a>
									@else
									<a  href="javascript::void(0)" onclick="document.getElementById('favorite-form-{{$randonpost->id}}').submit();"
									class="{{! Auth::user()->favorite_posts->where('pivot.post_id',$randonpost->id)->count()==0 ? 'favorite_post': ''}}"
									><i class="ion-heart"></i>{{$randonpost->favorite_to_user->count()}}</a>
<form id="favorite-form-{{$randonpost->id}}" action="{{route('post.favorite',$randonpost->id)}}" method="POST" style="display: none;">
@csrf


</form>
									@endguest
									</li>
									<li><a href="#"><i class="ion-chatbubble"></i>{{$randonpost->comments->count()}}</a></li>
									<li><a href="#"><i class="ion-eye"></i>{{$randonpost->view_count}}</a></li>
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-md-6 col-sm-12 -->
@endforeach
			
			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			@if(session('successMsg'))
                    <div class="alert alert-success m-t-15" role="alert">
                        {{session('successMsg')}}
                        @endif
                @if($errors->any())
                                @foreach($errors->all() as $error)
                                <div class="alert alert-danger m-t-15" role="alert">
                                        {{$error}}
                                </div>
                                   
                                @endforeach
                                @endif
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
			@guest
			<p>For post a comments ,you should to <span style="color:red"><a href="{{route('login')}}">login</a></span></p>
			@else
			<form method="post" action="{{route('comment.store',$posts->id)}}">
				@csrf
				@method('POST')
							<div class="row">


								<div class="col-sm-12">
									<textarea name="comment" rows="4" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>
			@endguest
					

					</div><!-- comment-form -->

					<h4><b>COMMENTS({{$posts->comments->count()}})</b></h4>
					@if($posts->comments->count() > 0)
						@foreach($posts->comments as $comment)
					<div class="commnets-area ">

						<div class="comment">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{Storage::disk('public')->url('profile/'.$comment->user->image)}}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{$comment->user->name}}</b></a>
									<h6 class="date">on {{$comment->created_at->diffForHumans()}}</h6>
								</div>

								

							</div><!-- post-info -->

							<p>{{$comment->comment}}</p>

						</div>

					</div><!-- commnets-area -->
						@endforeach
					<a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>
						@else

						<div class="commnets-area ">
						<p>No comment found.</p>
						</div>
						@endif
				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>
          
@endsection
@push('js')
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