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
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.0/angular-route.min.js"></script>

	<script src="/js/angular/controllers/competitionController.js" type="text/javascript"></script>
	<script src="/js/angular/services/competitionService.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(function(){
    $('.date').datetimepicker();
    })
    </script>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <header class="container-fluid">
        <section class="navbar-header">
            <a class="navbar-brand" href='/admin'>Administrator Dashboard</a>
        </section>
    </header>
</nav>


<section class="container-fluid">
    <section class="row">
        <nav class="col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="{{ ($activePanel == 'overview') ? 'active' : ''}}"><a href="/admin">Overview</a></li>
                <li class="{{ ($activePanel == 'fixtures') ? 'active' : ''}}"><a href="/admin/fixtures">Fixtures</a></li>
                <li class="{{ ($activePanel == 'teams') ? 'active' : ''}}"><a href="/admin/teams">Teams</a></li>
                <li class="{{ ($activePanel == 'competitions') ? 'active' : ''}}"><a href="/admin/competitions">Competitions</a></li>
            </ul>
        </nav>
        <section class="col-md-10 col-md-offset-2 main">
            <div ng-view></div>
        </section>
    </section>
</section>


    <script src="/js/angular/app.js" type="text/javascript"></script>
</body>
</html>
