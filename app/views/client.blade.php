@extends('layouts.master')

@section('content')
	<h1>World Cup Matches</h1>

	<table class="fixtures" cellspacing="0">
		<tbody>
			@foreach ($fixtures as $fixture)
				<tr id="{{$fixture->fixtureID}}">
					<td class="team home">{{$fixture->homeTeam->teamDetails->name}}</td>
					<td class="goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</td>
					<td class="goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</td>
					<td class="team away">{{$fixture->awayTeam->teamDetails->name}}</td>
					<td><button class="end-match" data-fixtureID="{{$fixture->fixtureID}}">End Match</button></td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<section id="ticker">
		
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