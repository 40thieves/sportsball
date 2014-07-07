@extends('layouts.master')

@section('content')
	<h1>Add User</h1>

	<form name="registrationForm" method="POST" action="/register">
		<label>Email</label>
		<input type="email" name="email"/>

		<label>Password</label>
		<input type="password" name="password"/>		

		<input type="submit" value="Submit"/>
	</form>
@stop