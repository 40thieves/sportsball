<!DOCTYPE html>
<html>
<head>
	<title>Angular Admin</title>

	<link rel="stylesheet" type="text/css" href="/packages/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/packages/bootstrap/css/bootstrap-dashboard.css">
	<link rel="stylesheet" type="text/css" href="/packages/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="/css/global.css">

	<script type="text/javascript" src="http://js.pusher.com/2.1/pusher.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" ></script>	
	<script src="/packages/bootstrap/js/bootstrap.min.js" ></script>
	<script src="/packages/moment/moment.min.js" ></script>
	<script src="/packages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" ></script>

	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.5/angular.min.js"></script>

	<script src="/js/angular/controllers/competitionCtrl.js" type="text/javascript"></script>
	<script src="/js/angular/services/competitionService.js" type="text/javascript"></script>
	<script src="/js/angular/app.js" type="text/javascript"></script>

	<script type="text/javascript">
		$(function(){
			$('.date').datetimepicker();
		})
	</script>

</head>
<body>
	
	<div ng-app="competitionApp" ng-controller="competitionController">
	
		<h1 class="page-header">Competitions</h1>

		<a class="btn btn-primary" href="/admin/competitions/new">Add New Competition</a>

		<div ng-hide="loading" ng-repeat="c in competitions">
			
			<p>{{ c.name }}</p>

			<p><a href="#" ng-click="deleteCompetition(c.competitionID)" class="btn btn-primary">Delete</a></p>
		</div>

	</div>

</body>
</html>