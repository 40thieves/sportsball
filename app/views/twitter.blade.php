@extends('layouts.master')

@section('content')
	<script type="text/javascript">
		setInterval(function(){ 
			$.get('/api/twitter')
			.done(function(response){
				console.log(response);
			})
		},30000);
	</script>
@stop