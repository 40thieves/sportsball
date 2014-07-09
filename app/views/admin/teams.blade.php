@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Teams</h1>

	@if (count($teams) > 0)

		@foreach ($teams as $team)
			<article class="row" id="{{$team->teamID}}">
				{{$team->name}}				
			</article>
		@endforeach

	@endif
	

@stop