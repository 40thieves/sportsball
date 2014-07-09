<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Real-Time Sports Statistics</title>

	<link rel="stylesheet" type="text/css" href="/packages/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/packages/bootstrap/css/bootstrap-dashboard.css">
	<link rel="stylesheet" type="text/css" href="/packages/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="/css/global.css">
	<script type="text/javascript" src="http://js.pusher.com/2.1/pusher.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>	
	<script src="/packages/bootstrap/js/bootstrap.min.js" ></script>
	<script src="/packages/moment/moment.min.js" ></script>
	<script src="/packages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" ></script>

	<script type="text/javascript">
		$(function(){
			$('.date').datetimepicker();
		})
	</script>
	<!--<script type="text/javascript" src="/js/global.js"></script>-->
</head>
<body>

	<div class="container">
		@yield('navigation')
		@yield('content')
	</div>

</body>
</html>