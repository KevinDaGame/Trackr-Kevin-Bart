@extends('layout')
@section('title')
    <title>Packages</title>
@endsection
@section('body')
    <form method="GET" action="#">
        <label for="nameSearch">Zoek een zender of ontvanger:</label>
        <input
            id="nameSearch"
            type="text"
            name="search"
            placeholder="zoek een zender of ontvanger"
            value="{{ request('search') }}">
    </form>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Sender</th>
            <th scope="col">Recipient</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
                <tr class="table-primary">
                    <th scope="row">{{$package->id}}</th>
                    <td>{{$package->sender->name}}</td>
                    <td>{{$package->recipient->fullName()}}</td>
                    <td>{{$package->status}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endsection
