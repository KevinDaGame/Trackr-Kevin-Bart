@extends('layout')
@section('title')
    <title>Trackr</title>
@endsection
@section('body')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Sender</th>
            <th scope="col">Recipient</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <form method="GET" action="generate-pdfs" id="selected-packages">
            <tbody>
            @foreach($packages as $package)
                <tr class="table-primary">
                    <th scope="row">{{$package->id}}</th>
                    <td>{{$package->sender->name}}</td>
                    <td>{{$package->recipient ?? false ? $package->recipient->name : ''}}</td>
                    <td>{{$package->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </form>
@endsection
