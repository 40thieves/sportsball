<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>

	<script type="text/javascript" src="http://js.pusher.com/2.1/pusher.min.js"></script>
</head>
<body>
	<div class="welcome">
		<h1>Pusher Test</h1>

		<script>
			var pusher = new Pusher('7b6a2e8dc8823ec90e0f')
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
