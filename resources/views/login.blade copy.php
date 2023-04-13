@extends('layout')

@section('content')

<h1>Home</h1>

<form action="{{ route("login") }}" method="POST">
  @csrf
  <input
    type="email"
    name="email"
    id="email-input"
    placeholder="Email"
  >

  <input
    type="password"
    name="password"
    id="password-input"
    placeholder="Password"
  >

  <button
    type="submit"
  >
    Login
  </button>
</form>

@endsection