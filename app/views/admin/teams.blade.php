@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Teams</h1>

	<a class="btn btn-primary" href="/admin/teams/new">Add New Team</a>

	@if (count($teams) > 0)

		@foreach ($teams as $team)
			<article class="row team" id="{{$team->teamID}}">
				<div class="col-md-10">{{$team->name}}</div>
				<a class="col-md-2" href="/admin/teams/{{$team->teamID}}">Details</a>
			</article>
		@endforeach

	@endif
	

@stop