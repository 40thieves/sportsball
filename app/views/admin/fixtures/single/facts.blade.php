@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">{{$fixture->homeTeam->teamDetails->name}} vs {{$fixture->awayTeam->teamDetails->name}}</h1>

	@foreach ($fixture->facts as $fact)

		<p>Hello</p>

	@endforeach

@stop