@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Add Fixture</h1>

	<form class="form-horizontal" name="fixtureAdd" method="POST" action="admin/fixture">

		<div class="form-group">
			<label class="control-label col-sm-2">Home Team</label>
			<div class="col-sm-10">
				<select class="form-control">
					@foreach ($teams as $team)
					
						<option value="{{$team->teamID}}">{{$team->name}}</option>

					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">Away Team</label>
			<div class="col-sm-10">
				<select class="form-control">
					@foreach ($teams as $team)
					
						<option value="{{$team->teamID}}">{{$team->name}}</option>

					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">Hash Tag</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="hashTag"/>
			</div>
		</div>
		
		<div class='form-group'>
			<label class="control-label col-sm-2">Start Time</label>
            <div class="col-sm-10">
	            <div class='input-group date'>
		            <input type='text' class="form-control" />
		            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	            </div>
			</div>
        </div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input class="btn btn-primary" type="submit" value="Add Fixture"/>
			</div>
		</div>

	</form>

@stop