@extends('layout')
@section('title')
    <title>Trackr</title>
@endsection
@section('body')
    <h1>{{__('Enter your track and trace code and postal code to find your package')}}</h1>
    <form action="findPackage" method="POST" id="findPackage">
        @csrf
        <div class="form-group row">

            <label class="form-label" for="trace-code">{{__('Track and trace code')}}</label>
            <input type="text" class="form-control" name="trace-code" id="trace-code" value="{{session()->has('trace-code') ? session()->get('trace-code') : old('trace-code')}}">
            @error('trace-code')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="form-group row">
            <label for="postal-code">{{__('Postal code')}}</label>
            <input type="text" name="postal-code" id="postal-code" value="{{session()->has('postal-code') ? session()->get('postal-code') : old('postal-code')}}">
            @error('postal-code')
            <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
    </form>
    <button type="submit" form="findPackage" class="btn btn-lg btn-primary m-2">{{__('Search')}}</button>

    @if(isset($package))
        <div class="row text-center">
            <h1>{{__('Current status')}}</h1>
            <h3>{{__($package->status->status)}}</h3>
            @if($package->delivered_date != null)
                <p>{{__('Delivered at: ')}}<span>{{$package->delivered_date}}</span></p>
            @elseif($package->sent_date != null)
                <p>{{__('Sent at: ')}}<span>{{$package->sent_date}}</span></p>
            @else
                <p>{{__('Last update: ')}}<span>{{$package->updated_at}}</span></p>
            @endif
            <div class="col card bg-primary text-white">
                <h2>{{__('Recipient')}}</h2>
                <p>{{$package->recipient->name}}</p>
                <p>{{$package->recipient->address->street}} {{$package->recipient->address->house_number}} {{$package->recipient->address->addition}}</p>
                <p>{{$package->recipient->address->city}}</p>
                <p>{{$package->recipient->address->country}}</p>
            </div>
            <div class="col card bg-secondary text-white">
                <h2>{{__('Sender')}}</h2>
                <p>{{$package->sender->name}}</p>
                <p>{{$package->sender->address->street}} {{$package->sender->address->house_number}} {{$package->sender->address->addition}}</p>
                <p>{{$package->sender->address->city}}</p>
                <p>{{$package->sender->address->country}}</p>
            </div>
        </div>
        @if(Auth::user() != null && Auth::user()->level() == 1)
            <form action="trackr/savepackage" method="POST">
                @csrf
                <input type="hidden" name="package_id" id="package_id" value="{{$package->id}}">
            <button class="btn btn-primary btn-lg m-2 align-self-center" type="submit">{{__('Save this package')}}</button>
            </form>
        @endif
    @endif
@endsection
