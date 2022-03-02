@extends('layout')
@section('title')
    <title>Packages</title>
@endsection
@section('body')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Sender</th>
            <th scope="col">Recipient</th>
        </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
                <tr class="table-primary">
                    <th scope="row">{{$package->id}}</th>
                    <td>{{$package->sender->name}}</td>
                    <td>{{$package->recipient->fullName()}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endsection
