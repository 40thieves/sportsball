@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">{{$fixture->homeTeam->teamDetails->name}} vs {{$fixture->awayTeam->teamDetails->name}}</h1>

	<article class="panel">
		<header>
			<h2>Events</h2>
		</header>

		@foreach ($fixture->events as $event)

			<p>{{$event->eventType->label}} {{$event->team->name}} {{$event->minute}}</p>

		@endforeach

	</article>

	<article id="twitterdata" class="panel">
		<header>
			<h2>Twitter Data</h2>
		</header>

		@foreach ($fixture->twitterresponses as $response)

			<section class="panel">

			@foreach ($response->tweets as $tweet)
				
				<p>{{$tweet->content}}</p>

			@endforeach

			</section>

		@endforeach

	</article>

@stop