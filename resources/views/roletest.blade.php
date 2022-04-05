@extends('layout')
@section('title')
    <title>Role test</title>
@endsection
@section('body')
    @foreach(Auth::user()->getRoles() as $role)
        {{$role}}
    @endforeach

@endsection
