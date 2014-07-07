@extends('layouts.master')

@section('content')
	
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
					<li><a href="#">Overview</a></li>
				</ul>
			</nav>
			<section class="col-md-10 col-md-offset-2 main">
				@yield('admin-content')
			</section>
		</section>
	</section>

@stop