@extends('layouts.master')

@section('content')
	<h1>Premier League Matches</h1>

	<table class="fixtures" cellspacing="0">
		<tbody>
			@foreach ($fixtures as $fixture)
				<tr id="{{$fixture->fixtureID}}">
					<td class="team home">{{$fixture->homeTeam->teamDetails->name}}</td>
					<td class="goals homeGoals" id="team-goals-{{$fixture->homeTeam->teamID}}">{{$fixture->homeTeam->goals}}</td>
					<td class="goals awayGoals" id="team-goals-{{$fixture->awayTeam->teamID}}">{{$fixture->awayTeam->goals}}</td>
					<td class="team away">{{$fixture->awayTeam->teamDetails->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<script>
		var pusher = new Pusher({{ '\'' . $pusherKey . '\'' }});

		var goalIncrementer = function(data) {
			var $goals = $('#team-goals-' + data.teamID)
			,	newGoals = parseInt($goals.html()) + 1
			;

			$goals.html(newGoals);
		}

		@foreach($fixtures as $fixture)
			var	channel_{{$fixture->fixtureID}} = pusher.subscribe('fixture_{{$fixture->fixtureID}}');

			channel_{{$fixture->fixtureID}}.bind('event_1', goalIncrementer);
		@endforeach
	</script>
@stop