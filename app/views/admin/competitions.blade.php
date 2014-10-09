@extends('layouts.admin')

@section('admin-content')
	
	<h1 class="page-header">Competitions</h1>

	<a class="btn btn-primary" href="/admin/competitions/new">Add New Competition</a>

	@if (count($competitions) > 0)

		@foreach ($competitions as $c)
			<article class="row competition" id="{{$c->competitionID}}">
				<div class="col-md-10">{{$c->name}}</div>
				<a class="col-md-2" href="/admin/competitions/{{$c->competitionID}}">Details</a>
			</article>
		@endforeach

	@endif
	

@stop