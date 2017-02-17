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
						<th>Writer</th>
						<th>Expertise</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user => $d)
					<tr>
						<td><a href="{{ url('/user/'.$d->author_id.'/posts')}}">{!!$d->firstname!!}</a></td>
						

							<td>
								@foreach ($d->expertises as $expertise)
								<a href="#">
									 {{$expertise->field}} 
								</a>
								@endforeach
							</td>

						
							<td>
								<a href="{{ url('/profile/'.$d->id)}}">View Profile</a>
							</td>
							
						</tr>

						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>


	@endsection
