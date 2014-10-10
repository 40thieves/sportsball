@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Add Team</h1>

	<form class="form-horizontal" name="teamAdd" method="POST" action="/admin/teams/new">		

		<div class="form-group">
			<label class="control-label col-sm-2">Name</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="name"/>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input class="btn btn-primary" type="submit" value="Add Team"/>
			</div>
		</div>

	</form>

@stop