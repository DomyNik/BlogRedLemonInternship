@extends('layouts.app')

@section('content')

<style>.btn span.glyphicon {    			
	opacity: 0;				
}
.btn.active span.glyphicon {				
	opacity: 1;				
}</style>
<div class="container">
	<h1 class="text-center">Checkbox/Radio - CSS Only</h1>
</div>

<div class="container">

	<div class="well well-sm text-center">

		<h3>Checkbox</h3>
		
		<div class="btn-group" data-toggle="buttons">
			
			<label class="btn btn-success active">Nature
				<input type="checkbox" autocomplete="off" checked>
				<span class="glyphicon glyphicon-ok"></span>
			</label>

			<label class="btn btn-primary">Travel
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
			<label class="btn btn-info">Friendship
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
			<label class="btn btn-default">Techonology
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			

			<label class="btn btn-warning">Enterntainment
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
			<label class="btn btn-danger">Love
				<input type="checkbox" autocomplete="off">
				<span class="glyphicon glyphicon-ok"></span>
			</label>			
		
		</div>

	</div>

</div>


  
@endsection