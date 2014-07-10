@extends('layouts.master')

@section('content')
	<h1 class="jumbotron">World Cup Matches</h1>

	<section class="row">
		<section class="fixtures col-md-8">

			<h2>Ongoing Fixtures</h2>
					
			@foreach ($ongoingFixtures as $fixture)
				<article class="row fixture" id="{{$fixture->fixtureID}}">
					<div class="col-md-5 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
					<div class="col-md-1 goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</div>
					<div class="col-md-1 goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</div>
					<div class="col-md-5 team away">{{$fixture->awayTeam->teamDetails->name}}</div>
				</article>
			@endforeach

			<h2>Recent Fixtures</h2>
					
			@foreach ($pastFixtures as $fixture)
				<article class="row fixture" id="{{$fixture->fixtureID}}">
					<div class="col-md-5 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
					<div class="col-md-1 goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</div>
					<div class="col-md-1 goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</div>
					<div class="col-md-5 team away">{{$fixture->awayTeam->teamDetails->name}}</div>
				</article>
			@endforeach

			<h2>Coming Up</h2>

			@foreach ($futureFixtures as $fixture)
				<article class="row fixture" id="{{$fixture->fixtureID}}">
					<div class="col-md-5 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
					<div class="col-md-2 startTime" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->startTime}}</div>					
					<div class="col-md-5 team away">{{$fixture->awayTeam->teamDetails->name}}</div>{{$fixture->startTime}}
				</article>
			@endforeach

		</section>

		<section id="ticker" class="col-md-4">

			<h2>Latest Events</h2>
			
		</section>
	</section>

	<script>
		var pusher = new Pusher({{ '\'' . $pusherKey . '\'' }});

		@foreach($ongoingFixtures as $fixture)
			var	channel_{{$fixture->fixtureID}} = pusher.subscribe('fixture_{{$fixture->fixtureID}}');
			channel_{{$fixture->fixtureID}}.bind('event_goal', global.goalIncrementer);
			channel_{{$fixture->fixtureID}}.bind('event_all', global.ticker.update);
		@endforeach
	</script>
	<?php echo date("y-m-d h:i:s"); ?>					
@stop