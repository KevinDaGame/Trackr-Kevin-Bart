@extends('layout')
@section('title')
    <title>{{__('Request pickup')}}</title>
@endsection
@section('body')
    <h1>{{__('Request pickup')}}</h1>

    <form action="/requestpickup" method="POST" class="mt-1 p-3">
        @csrf
        <div class="row mt-3">
            <div class="col-md mb-6">
                <label class="form-label" for="transporter">{{__('Transporter')}}:</label>
                <select class="form-control" name="transporter" id="transporter" required>
                    <option value="PostNL">PostNL</option>
                    <option value="DHL">DHL</option>
                    <option value="DPD">DPD</option>
                    <option value="UPS">UPS</option>
                    <option value="GLS">GLS</option>
                </select>
                @error('transporter')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="col-md">
                <label class="form-label" for="time">{{__('Time')}}:</label>
                <input
                    type="date"
                    class="form-control"
                    name="time"
                    id="time"
                    value="{{old('time')}}"
                    required>
                @error('time')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <label class="mt-3" for="package[]">{{__('Select the packages to pick up')}}:</label>
        <select name="package[]" id="package" class="form-control" multiple required>
            @foreach($packages as $package)
                <option value="{{ $package->id }}">
                    {{$package->id}},
                    {{$package->sender->name}},
                    {{$package->recipient->name}}
                </option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-primary mt-3" id="login" value="{{__('Submit')}}">
    </form>
@endsection
