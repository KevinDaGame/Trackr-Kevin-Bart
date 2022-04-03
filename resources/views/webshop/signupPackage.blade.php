@extends('layout')
@section('title')
    <title>Package Signup</title>
@endsection
@section('body')
    <form action="/addpackage" method="POST" class="mt-1 p-3">
        @csrf
        <div class="row">
            <div class="col-md mb-6">
                <h4>{{__('Sender')}}</h4>
            </div>
            <div class="col-md mb-6">
                <h4>{{__('Recipient')}}</h4>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md mb-6">
                <label class="form-label" for="sender-name">{{__('Name')}}</label>
                <input
                    class="form-control"
                    type="text"
                    name="sender-name"
                    id="sender-name"
                    value="{{old('sender-name')}}"
                    required>
                @error('sender-name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="col-md mb-6">
{{--                <label class="form-label" for="recipient-first-name">{{__('First name')}}</label>--}}
{{--                <input--}}
{{--                    class="form-control"--}}
{{--                    type="text"--}}
{{--                    name="recipient-first-name"--}}
{{--                    id="recipient-first-name"--}}
{{--                    value="{{old('recipient-first-name')}}"--}}
{{--                    required>--}}
{{--                @error('recipient-first-name')--}}
{{--                <p class="text-danger">{{$message}}</p>--}}
{{--                @enderror--}}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-md mb-6">
                        <label class="form-label" for="sender-street">{{__('Street')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="sender-street"
                            id="sender-street"
                            value="{{old('sender-street')}}"
                            required
                        >
                        @error('sender-street')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md mb-6">
                                <label class="form-label" for="sender-house_number">{{__('House number')}}</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="sender-house_number"
                                    id="sender-house_number"
                                    value="{{old('sender-house_number')}}"
                                    required
                                >
                                @error('sender-house_number')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-md mb-6">
                                <label class="form-label" for="sender-addition">{{__('Addition')}}</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="sender-addition"
                                    id="sender-addition"
                                    value="{{old('sender-addition')}}"
                                >
                                @error('sender-addition')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md mb-6">
                {{--                <label class="form-label" for="recipient-last-name">{{__('Last name')}}</label>--}}
                {{--                <input--}}
                {{--                    class="form-control"--}}
                {{--                    type="text"--}}
                {{--                    name="recipient-last-name"--}}
                {{--                    id="recipient-last-name"--}}
                {{--                    value="{{old('recipient-last-name')}}"--}}
                {{--                    required--}}
                {{--                >--}}
                {{--                @error('recipient-last-name')--}}
                {{--                <p class="text-danger">{{$message}}</p>--}}
                {{--                @enderror--}}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-md mb-6">
                        <label class="form-label" class="form-label" for="sender-postal_code">{{__('Postal code')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="sender-postal_code"
                            id="sender-postal_code"
                            value="{{old('sender-postal_code')}}"
                            required
                        >
                        @error('sender-postal_code')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md mb-6">
                        <label class="form-label" for="sender-city">{{__('City')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="sender-city"
                            id="sender-city"
                            value="{{old('sender-city')}}"
                            required
                        >
                        @error('sender-city')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md mb-6">
                        <label class="form-label" for="sender-country">{{__('Country')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="sender-country"
                            id="sender-country"
                            value="{{old('sender-country')}}"
                            required
                        >
                        @error('sender-country')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md mb-6">

            </div>
        </div>

        <input type="submit" class="btn btn-primary mt-3" value="{{__('Submit')}}">
    </form>
@endsection
