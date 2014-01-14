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

	<script>
		var pusher = new Pusher({{ '\'' . $pusherKey . '\'' }});

		var goalCallback = function(data) {
			console.log('Goal recieved!');
			console.log('Here\'s the data: ', data);
		}

		<?php foreach($fixtures as $fixture) : ?>
			<?php $id = $fixture->fixtureID; ?>
			var	channel_<?php echo $id; ?> = pusher.subscribe('fixture_<?php echo $id; ?>');

			channel_<?php echo $id; ?>.bind('event_1', goalCallback);
		<?php endforeach; ?>
	</script>
@stop