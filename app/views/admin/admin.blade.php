@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Admin Home</h1>

	<h2>Ongoing Fixtures</h2>
					
	@if (count($fixtures) > 0)

		@foreach ($fixtures as $fixture)
			<article class="row fixture" id="{{$fixture->fixtureID}}">
				<div class="col-md-5 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
				<div class="col-md-1 goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</div>
				<div class="col-md-1 goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</div>
				<div class="col-md-5 team away">{{$fixture->awayTeam->teamDetails->name}}</div>
			</article>
		@endforeach

	@else

		<p>No Fixtures Currently Ongoing</p>

	@endif

@stop