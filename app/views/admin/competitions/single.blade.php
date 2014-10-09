@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">{{$competition->name}}</h1>

	<article class="panel">
		<header>
			<h2>Teams</h2>
		</header>

		@foreach ($competition->teams as $team)

			<p>{{$team->name}}</p>

		@endforeach
		
		<a class="btn btn-primary" href="/admin/competition/{{$competition->competitionID}}/teams">Add New</a>

	</article>

@stop