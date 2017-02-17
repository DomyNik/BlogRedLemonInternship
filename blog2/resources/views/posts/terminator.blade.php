@extends('layouts.app')
@section('title')
{{$title}}
@endsection
@section('content')
<meta name="viewport" content="width-device-width, initial-scale=1">
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
{{-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>  --}}
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4> My Blog </h4>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Title</th>
							<th>Author</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($posts as $post)
						<tr>
							<td><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a></td>
							
							<td><a href="{{ url('/user/'.$post->author_id.'/posts')}}">{{ $post->author->firstname }}</a></td>

							<td>
								{{-- <a href="#">View</a> | --}} 
								<a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}">Delete</a> 
								{{-- <a href="#">Edit</a> --}}
							</td>

						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>


	@endsection
