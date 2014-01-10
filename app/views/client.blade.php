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
		var pusher = new Pusher({{ '\'' . $pusherKey . '\'' }})
		,	channel = pusher.subscribe('test-channel')
		;

		channel.bind('test-event', function(data) {
			console.log('Notification recieved!');
			console.log('Here\'s the data: ', data);
		});
	</script>
@stop