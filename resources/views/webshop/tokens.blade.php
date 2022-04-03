@extends('layout')
@section('title')
    <title>Tokens</title>
@endsection
@section('body')
    <h1>Tokens</h1>
    <form method="POST" action="{{url('createToken')}}" id="new-token">
        @csrf
        <input type="text" id="tokenName" name="tokenName">
        <button type="submit" class="btn btn-primary btn-sm" form="new-token">{{__('Create token')}}</button>
    </form>


    @if(session()->has('token'))
        <div class="card border-primary mb-3">
            <div class="card-header">Token created!</div>
            <div class="card-body">
                <h4 class="card-title">Your token: {{session()->get('token')}}</h4>
                <p class="card-text">Keep this token safe! This is the only time you will see it</p>
            </div>
        </div>
    @endif

        <form method="POST" action="{{url('deleteToken')}}" id="selected-tokens">
    <table class="table table-hover">
        <thead>
        <tr>
            <th></th>
            <th scope="col">name</th>
        </tr>
        </thead>

            @csrf
            <tbody>
            @foreach($tokens as $token)
                <tr class="table-primary">
                    <td><input type="checkbox" name="dl[]" value="{{$token->id}}"></td>
                    <th scope="row">{{$token->name}}</th>
                </tr>
            @endforeach
            </tbody>

    </table>
        </form>
            <button type="submit" class="btn btn-primary btn-sm" form="selected-tokens">{{__('Delete token')}}</button>
@endsection
