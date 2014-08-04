@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">{{$fixture->homeTeam->teamDetails->name}} vs {{$fixture->awayTeam->teamDetails->name}}</h1>

	{{ Form::open([ 'url' => "/admin/fixtures/$fixture->fixtureID/facts"]) }}

		{{ Form::hidden('fixtureID',$fixture->fixtureID) }}

		{{ Form::label('eventID', 'Event ID') }}
		{{ Form::select('eventID',[
			1 => 'Goal'
		]) }}

		{{ Form::label('teamID','Team') }}
		{{ Form::select('teamID',[
			$fixture->homeTeam->teamDetails->teamID => $fixture->homeTeam->teamDetails->name,
			$fixture->awayTeam->teamDetails->teamID => $fixture->awayTeam->teamDetails->name
		]) }}

	{{ Form::close() }}

	@foreach ($fixture->facts as $fact)

		<p>Hello</p>

	@endforeach

@stop