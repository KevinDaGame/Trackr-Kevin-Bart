@extends('layout')
@section('title')
    <title>Trackr</title>
@endsection
@section('body')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">{{__('Sender')}}</th>
            <th scope="col">{{__('Recipient')}}</th>
            <th scope="col">{{__('Status')}}</th>
        </tr>
        </thead>
            <tbody>
            @foreach($packages as $package)
                <tr class="table-primary">
                    <th scope="row">{{$package->id}}</th>
                    <td>{{$package->sender->name}}</td>
                    <td>{{$package->recipient ?? false ? $package->recipient->name : ''}}</td>
                    <td>{{$package->status->status}}</td>
                </tr>
            @endforeach
            </tbody>
@endsection
