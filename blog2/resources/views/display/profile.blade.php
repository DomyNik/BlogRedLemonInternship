@extends('layouts.app')

@section('title')
{{ $user->firstname }}
@endsection

@section('content')
<div>

@if (Session::has('message'))
	<div class="flash alert-info">
		<p class="panel-body">
			{{ Session::get('message') }}
		</p>
	</div>
	@endif
	
	<ul class="list-group">
		<li class="list-group-item">
			Joined on {{$user->created_at->format('M d,Y \a\t h:i a') }}
		</li>
		<li class="list-group-item panel-body">
			<table class="table-padding">
				<style>
					.table-padding td{
						padding: 3px 8px;
					}
				</style>
				<tr>
					<td>Total Posts</td>
					<td> {{$posts_count}}</td>
					
				</tr>
				<tr>
					<td>Published Posts</td>
					<td>{{$posts_published_count}}</td>
					
				</tr>
				<tr>
					<td>Posts in Draft </td>
					<td>{{$posts_draft_count}}</td>
					
				</tr>
			</table>
		</li>
		<li class="list-group-item">
			{{-- Total Comments {{$comments_count}} --}}
		</li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h3>Expertise</h3></div>
	{{-- <div class="panel-body">
		@if(!empty($latest_posts[0]))
		@foreach($latest_posts as $latest_post)
			<p>
				<strong><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
				<span class="well-sm">On {{ $latest_post->created_at->format('M d,Y \a\t h:i a') }}</span>
			</p>
		@endforeach
		@else
		<p>You have not written any post till now.</p>

		@endif
		--}}

		@if(Auth::user()->is_editor())
		{!! Form::open(array('url' => '/profile/'.$user->id.'/update')) !!}
		@endif
		{{ Form::label('ExpertiseLabel', 'Expertises:') }}

		@foreach($expertise_items as $expertise)
		<?php $checked = in_array($expertise->id, $old_expertise->lists('id')->toArray());
		?>

		{!! Form::checkbox('expertise[]', "$expertise->id')", $checked, ['class' => 'form-group']) !!}

		{{ Form::label("$expertise->field")}} &nbsp;

		@endforeach
		<br>
		{{-- <a href="{{  url('/profile/'.'update') }}" class="btn btn-success">Change</a> --}}
		@if(Auth::user()->is_editor())
		{!! Form::submit('Change') !!}
		@endif
		
		@if(Auth::user()->is_contributor())
		{!! Form::submit('Be an editor to change expertise') !!}
		@endif
		{!! Form::close() !!}
	</div>
</div>

{{-- <div class="panel panel-default">
	<div class="panel-heading"><h3>Latest Comments</h3></div>
	<div class="list-group">
		@if(!empty($latest_comments[0]))
		@foreach($latest_comments as $latest_comment)
			<div class="list-group-item">
				<p>{{ $latest_comment->body }}</p>
				<p>On {{ $latest_comment->created_at->format('M d,Y \a\t h:i a') }}</p>
				<p>On post <a href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
			</div>
		@endforeach
		@else
		<div class="list-group-item">
			<p>You have not commented till now. Your latest 5 comments will be displayed here</p>
		</div>
		@endif
	</div>
</div> --}}
@endsection
