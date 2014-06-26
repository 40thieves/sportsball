@extends('layouts.master')

@section('content')
	<h1 class="jumbotron">World Cup Matches</h1>

	<section class="row">
		<section class="fixtures col-md-8">

			<h2>Ongoing Fixtures</h2>
					
			@foreach ($fixtures as $fixture)
				<article class="row fixture" id="{{$fixture->fixtureID}}">
					<div class="col-md-5 team home">{{$fixture->homeTeam->teamDetails->name}}</div>
					<div class="col-md-1 goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</div>
					<div class="col-md-1 goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</div>
					<div class="col-md-5 team away">{{$fixture->awayTeam->teamDetails->name}}</div>{{$fixture->startTime}}
					<!-- <td><button class="end-match" data-fixtureID="{{$fixture->fixtureID}}">End Match</button></td> -->
				</article>
			@endforeach

		</section>

		<section id="ticker col-md-4">

			<h2>Latest Events</h2>
			
		</section>
	</section>

	<script>
		var pusher = new Pusher({{ '\'' . $pusherKey . '\'' }});

		@foreach($fixtures as $fixture)
			var	channel_{{$fixture->fixtureID}} = pusher.subscribe('fixture_{{$fixture->fixtureID}}');
			channel_{{$fixture->fixtureID}}.bind('event_goal', global.goalIncrementer);
			channel_{{$fixture->fixtureID}}.bind('event_all', global.ticker.update);
		@endforeach
	</script>
@stop