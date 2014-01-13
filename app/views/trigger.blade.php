@extends('layouts.master')

@section('content')
	<h1>Add Event</h1>

	<form name="trigger">
		<label for="eventID">*Select Event</label>
		<select name="eventID">
			<option>SELECT</option>
			@foreach ($events as $event)
				<option value="{{$event->eventID}}">{{$event->label}}</option>
			@endforeach
		</select>
		<label for="fixtureID">*Select Fixture</label>
		<select name="fixtureID">
			<option>SELECT</option>
			@foreach ($fixtures as $fixture)
				<option value="{{$fixture->fixtureID}}">{{$fixture->homeTeam->teamDetails->name}} vs {{$fixture->awayTeam->teamDetails->name}}</option>
			@endforeach
		</select>
		
		<label for="minute">*Set Minute</label>
		<input name="minute" type="number"/>

		<input type="submit" value="Submit"/>
	</form>
@stop