@extends('layouts.app')

@section('content')
<div class="container">
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
	<script src="jquery-3.1.1.js"></script>
	<script type="parsley.min.js"></script>



	<div class="container">

	@if (Session::has('message'))
	<div class="flash alert-info">
		<p class="panel-body">
			{{ Session::get('message') }}
		</p>
	</div>
	@endif

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Edit</h4>
			</div>
			<div class="panel-body">
				<form action="{{url('/update')}}" method="post">
					<input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
					<div class="form-group">
						<label for="title">Title</label>
						<input required="required" value="{{ $post->title }}" placeholder="Enter title here" type="text" name="title" id="title" class="form-control">
						<br>
						@if(Auth::user()->is_editor())


						<div class="form-group" >
							{{-- {!! Form::open(array('data-parsley-validate' => ''))!!} --}}
							{{ Form::label('categoryLabel', 'Categories:') }}
							<br>
							@foreach($category_items as $category)
							<?php $checked = in_array($category->id, $old_categories->lists('id')->toArray());
							?>

							{!! Form::checkbox('categories[]', "$category->id')", $checked, ['class' => 'form-group']) !!}

							{{ Form::label("$category->name")}} &nbsp;

							@endforeach


						</div>

				{{--  {{ Form::checkbox('category[]', 1, true) }}Love  
				 {{ Form::checkbox('category[]', 2, true) }}Technology  
				 {{ Form::checkbox('category[]', 3, true) }}Travel   --}}
				 {{-- <div class="form-group"></div> --}}
					{{-- <label for="">Category</label>
					<select class="form-control input-sm" name="category_id" >
						@foreach($categories as $category)
							<option value="{{$category->id}}" >{{$category->name}}</option>
						@endforeach
					</select> --}}
					{{-- <input type="checkbox" name="category[]" value="1" />Love<br />
					<input type="checkbox" name="category[]" value="2" />Technology<br />
					<input type="checkbox" name="category[]" value="3" />Travel<br />
					</div>
					--}}
					@endif


					
				</div>


				<div class="form-group">
					<textarea id="summernote" name="summernote" class="form-control" >{!!$post->contents!!}</textarea>
				</div>
				<div class="form-group">
					@if($post->status== 'published')
						<input type="submit" name='publish' class="btn btn-success" value = "Update"/>
						
					@endif

					@if($post->status== 'draft')
						@if(Auth::user()->is_editor())
						<input type="submit" name='publish' class="btn btn-success" value = "Update"/>
						@endif
						@if(Auth::user()->is_contributor())
						<input type="submit" name='pending' class="btn btn-success" value = "Forward to Editors"/>
						@endif
					<input type="submit" name='save' class="btn btn-default" value = "Save As Draft" />
					@endif

					@if($post->status== 'pending')
						@if(Auth::user()->is_editor())
						<input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
						@endif
					<input type="submit" name='save' class="btn btn-default" value = "Save As Draft" />
					@endif





					<a href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
				<!--
			<input type="submit" name="publish" id="send" value="Publish" class="btn btn-success">
			<input type="submit" name="draft" id="clear" value="Draft" class="btn btn-danger">
		-->
		{{ csrf_field() }}
	</div>
</form>


</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#summernote').summernote({
			height:'300px',
			placeholder:'Content here...',
		})

	})
</script>



@endsection
