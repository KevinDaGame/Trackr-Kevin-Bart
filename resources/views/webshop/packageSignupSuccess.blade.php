@extends('layout')
@section('title')
    <title>Success</title>
@endsection
@section('body')
    <h4>{{__('The following packages are succesfully added')}}:</h4>
    <table class="table table-primary">
        <thead>
            <tr>
                <th>{{__('Email address')}}</th>
                <th>Track & Trace</th>
            </tr>
        </thead>
        <tbody>
        @foreach($packageIds as $name => $id)
            <tr>
                <td>{{$name}}</td>
                <td>{{$id}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
