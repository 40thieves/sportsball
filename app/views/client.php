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
			,	channel = pusher.subscribe('my-channel')
			;

			channel.bind('my-event', function(data) {
				console.log('foo');
			});
		</script>
	</div>
</body>
</html>
