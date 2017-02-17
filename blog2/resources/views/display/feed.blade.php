@extends('layouts.app')

@section('title')
{{$title}}
@endsection
@section('content')


<div class="container">
	

	@if (Session::has('message'))
	<div class="flash alert-info">
		<p class="panel-body">
			{{ Session::get('message') }}
		</p>
	</div>
	@endif


	@if ( !$posts->count() )
	No posts to show.
	@else

	<div class="">

		@foreach( $posts as $post )
		<div class="list-group">
			<div class="list-group-item">
				<h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
					@if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_editor()))

					@if(($post->status == 'published') && (Auth::user()->is_editor()))
					<button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
					@endif

					@if(($post->status =='draft') && (($post->author_id == Auth::user()->id)))
					<button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>

					@endif

					@if(($post->status =='pending') && (Auth::user()->is_editor()))
					<button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Evaluate Pending</a></button>

					@endif
					@endif
				</h3>
				<p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id.'/posts')}}">{{ $post->author->firstname }}</a><Br> Category: 

					@foreach ($post->categories as $category)
					<a href="{{ url('/category/'.$category->name)}}">
						 {{$category->name}} 
					</a>
					@endforeach

				</p>

			</div>
			
			<div class="list-group-item">
				<article>
					{!! str_limit($post->contents, $limit = 50, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
				</article>
			</div>
		</div>
		@endforeach
		{{-- {!! $posts->render() !!} --}}
		{{ $posts->links() }}
		
	

</div>
@endif
@endsection
