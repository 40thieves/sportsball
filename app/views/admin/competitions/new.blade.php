@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Add Competition</h1>

	<form class="form-horizontal" name="competitionAdd" method="POST" action="/admin/competitions/new">		

		<div class="form-group">
			<label class="control-label col-sm-2">Name</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="name"/>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input class="btn btn-primary" type="submit" value="Add Competition"/>
			</div>
		</div>

	</form>

@stop