
@extends('layouts.app')

@section('content')
<div class="container">
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4> Write</h4>
			</div>
			<div class="panel-body">
				<form action="{{url('insert')}}" method="post">

					<div class="form-group">
						<label for="title">Title</label>
						<input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name="title" id="title" class="form-control">
<br>
					@if(Auth::user()->is_editor())
				
 				<div class="form-group" >
{{ Form::label('categoryLabel', 'Categories:') }}
							<br>
							@foreach($category_items as $category)
							

							{!! Form::checkbox('categories[]', "$category->id')", null, ['class' => 'form-group']) !!}

							{{ Form::label("$category->name")}} &nbsp;

							@endforeach

				</div>

				@endif

					</div>



					<div class="form-group">
						<textarea id="summernote" name="summernote" class="form-control"></textarea>
					</div>
					<div class="form-group">

						<!--if user is an editor, they can publish posts directly-->
						@if( Auth::user()->is_editor())           <input type="submit" name="publish"
						id="send" value="Publish" class="btn btn-success">

						@else
						<input type="submit" name="pending" id="send" value="Forward to Editors" class="btn btn-success">

						@endif
						<input type="submit" name="draft" id="clear" value="Save as Draft" class="btn btn-danger">
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
</div>
	@endsection
