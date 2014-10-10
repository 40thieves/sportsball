@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">{{$competition->name}}</h1>

	<article class="panel">
		<header>
			<h2>Fixtures</h2>
		</header>

		@foreach ($competition->fixtures as $fixture)

			<article class="row fixture" id="{{$fixture->fixtureID}}">
				<div class="col-md-4 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
				<div class="col-md-1 goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</div>
				<div class="col-md-1 goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</div>
				<div class="col-md-4 team away">{{$fixture->awayTeam->teamDetails->name}}</div>
				<a class="col-md-2" href="/admin/fixtures/{{$fixture->fixtureID}}">Details</a>
			</article>

		@endforeach
	</article>

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