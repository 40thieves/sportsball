@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Add Fixture</h1>

	<form class="input-group" name="fixtureAdd" method="POST" action="admin/fixture">

		<label>Home Team</label>
		<label>Away Team</label>

		<label>Hash Tag</label>
		<input class="form-control" type="text" name="hashTag"/>

		<label>Start Time</label>
		<input class="form-control" type="date" name="startTime"/>

		<input type="submit" value="Add Fixture"/>

	</form>

@stop