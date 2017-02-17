@extends('layouts.app')

@section('title')
{{$title}}
@endsection

@section('content')
	@if($post)
		@if (Session::has('message'))
			<div class="flash alert-info">
				<p class="panel-body">
					{{ Session::get('message') }}
				</p>
			</div>
			@endif
			@if ($errors->any())
			<div class='flash alert-danger'>
				<ul class="panel-body">
					@foreach ( $errors->all() as $error )
					<li>
						{{ $error }}
					</li>
					@endforeach
				</ul>
			</div>
			@endif



		@if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_editor()))
			<button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
		@endif


	@else
		Page does not exist
	@endif

<p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->firstname }}</a></p>
Category: 
@foreach ($post->categories as $category)
					<a href="{{ url('/category/'.$category->name)}}">
						 {{$category->name}} 
					</a>
					@endforeach
<div>
		{!! $post->contents !!}
	</div>	

@endsection