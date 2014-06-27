@extends('layouts.master')

@section('content')
	<h1>Add User</h1>

	<form name="registrationForm" method="POST" action="/register">
		<label>Username</label>
		<input type="text" name="username"/>

		<label>Password</label>
		<input type="password" name="password"/>		

		<input type="submit" value="Submit"/>
	</form>
@stop