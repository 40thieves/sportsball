@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="jumbotron page-header">{{$competition->name}}</h1>

	<article class="panel">
		<header>
			<h2>Current Teams</h2>
		</header>

		@foreach ($competition->teams as $team)

			<article class="row">
				<div class="col-sm-8">{{$team->name}}</div>
				<div class="col-sm-4"></div>
			</article>

		@endforeach

	</article>

	<article class="panel">
		<header>
			<h2>Add Teams</h2>
		</header>

		@foreach ($teams as $team)

			<article class="row">
				<div class="col-sm-8">{{$team->name}}</div>
				<div class="col-sm-4">
					<a class="btn-link" data-team="{{$team->id}}">Add Team</a>
				</div>
			</article>

		@endforeach

	</article>

@stop