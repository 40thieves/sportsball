@extends('layouts.master')

@section('content')
	<script type="text/javascript">
		setInterval(function(){ 
			$.get('/api/twitter/fixture/{{$fixtureId}}')
			.done(function(response){
				console.log(response);
			})
		},30000);
	</script>
@stop