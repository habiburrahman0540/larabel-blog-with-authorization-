@extends('layouts.frontend.app')
@section('title')
{{ $query }}
@endsection

@push('css')
<link href="{{asset('public/assets/frontend/css/category/styles.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/frontend/css/category/responsive.css')}}" rel="stylesheet">
<link href="{{asset('public/assets/frontend/css/ionicons.css')}}" rel="stylesheet">

@endpush
@section('content')
<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{$posts->count()}} Results For {{ $query }}</b></h1>
	</div><!-- slider -->
	<section class="blog-area section">
		<div class="container">
			<div class="row">
                
                @if($posts->count() > 0)
            @foreach($posts as $post)
				<div class="col-lg-4 col-md-6">
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
    @else
    <div class="col-lg-12 col-md-12">
					<div class="card h-100">
						<div class="single-post post-style-1">

                            <h2>No post found by same Search.</h2>
					</div>
				</div>
			</div>
    @endif
				
			</div><!-- row -->
           
		</div><!-- container -->
	</section><!-- section -->        
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