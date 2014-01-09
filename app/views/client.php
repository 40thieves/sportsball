<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>

	<link rel="stylesheet" type="text/css" href="/css/global.css">
	<script type="text/javascript" src="http://js.pusher.com/2.1/pusher.min.js"></script>
</head>
<body>
	<div class="welcome">
		<h1>Pusher Test</h1>

		<table class="fixtures" cellspacing="0">
			<tbody>
				<tr id="match123">
					<td class="team home">Arsenal</td>
					<td class="goals homeGoals">0</td>
					<td class="goals awayGoals">1</td>
					<td class="team away">Chelsea</td>
				</tr>
				<tr id="match124">
					<td class="team home">Crystal Palace</td>
					<td class="goals homeGoals">2</td>
					<td class="goals awayGoals">0</td>
					<td class="team away">Tottenham</td>
				</tr>
			</tbody>
		</table>

		<form id="form">
			<button>Test</button>
		</form>

		<script>
			var pusher = new Pusher(<?php echo '\'' . Config::get('pusherer::key') . '\'' ?>)
			,	channel = pusher.subscribe('test-channel')
			;

			channel.bind('test-event', function(data) {
				console.log('Notification recieved!');
				console.log('Here\'s the data: ', data);
			});
		</script>
	</div>
</body>
</html>
