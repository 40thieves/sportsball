@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Fixtures</h1>

	<a class="btn btn-primary" href="/admin/fixtures/new">Add New Fixture</a>

	<h2>Ongoing Fixtures</h2>
					
	@if (count($ongoingFixtures) > 0)

		@foreach ($ongoingFixtures as $fixture)
			<article class="row fixture" id="{{$fixture->fixtureID}}">
				<div class="col-md-4 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
				<div class="col-md-1 goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</div>
				<div class="col-md-1 goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</div>
				<div class="col-md-4 team away">{{$fixture->awayTeam->teamDetails->name}}</div>
				<a class="col-md-2" href="/admin/fixtures/{{$fixture->fixtureID}}">Details</a>
			</article>
		@endforeach

	@else

		<p>No Fixtures Currently Ongoing</p>

	@endif

	<h2>Recent Fixtures</h2>
					
	@if (count($recentFixtures) > 0)

		@foreach ($recentFixtures as $fixture)
			<article class="row fixture" id="{{$fixture->fixtureID}}">
				<div class="col-md-4 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
				<div class="col-md-1 goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</div>
				<div class="col-md-1 goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</div>
				<div class="col-md-4 team away">{{$fixture->awayTeam->teamDetails->name}}</div>
				<a class="col-md-2" href="/admin/fixtures/{{$fixture->fixtureID}}">Details</a>
			</article>
		@endforeach

	@else

		<p>No Fixtures Happened Ever!</p>

	@endif

@stop