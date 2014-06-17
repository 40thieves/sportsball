@extends('layouts.master')

@section('content')
	<script type="text/javascript">
		setInterval(function(){ 
			$.get('/api/twitter/fixture/{{$fixtureId}}') 
		},30000);
	</script>
@stop