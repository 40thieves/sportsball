@extends('layouts.master')

@section('content')
	<h1>Premier League Matches</h1>

	<table class="fixtures" cellspacing="0">
		<tbody>
			@foreach ($fixtures as $fixture)
				<tr id="{{$fixture->fixtureID}}">
					<td class="team home">{{$fixture->homeTeam->teamDetails->name}}</td>
					<td class="goals homeGoals">{{$fixture->homeTeam->goals}}</td>
					<td class="goals awayGoals">{{$fixture->awayTeam->goals}}</td>
					<td class="team away">{{$fixture->awayTeam->teamDetails->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<section id="ticker">
		
	</section>

	<script>
		var pusher = new Pusher({{ '\'' . $pusherKey . '\'' }});

		var goalCallback = function(data) {
			console.log('Goal recieved!');
			console.log('Here\'s the data: ', data);
		}

		@foreach($fixtures as $fixture)
			var	channel_{{$fixture->fixtureID}} = pusher.subscribe('fixture_{{$fixture->fixtureID}}');

			channel_{{$fixture->fixtureID}}.bind('event_1', goalCallback);
		@endforeach
	</script>
@stop