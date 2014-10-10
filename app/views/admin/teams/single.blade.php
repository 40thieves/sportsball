@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">{{$team->name}}</h1>

	<article class="panel">
		<header>
			<h2>Competitions</h2>
		</header>

		@foreach ($team->competitions as $competition)

			<p>{{$competition->name}}</p>

		@endforeach
		
		<a class="btn btn-primary" href="/admin/team/{{$team->teamID}}/competitions">Add New</a>

	</article>

	<article>
		<header>
			<h2>Fixtures</h2>
		</header>


	</article>

@stop