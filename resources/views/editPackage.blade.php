@extends('layout')
@section('title')
    <title>{{__('Edit package')}}</title>
@endsection
@section('body')
    <form action="/editpackage" method="POST" class="mt-1 p-3">
        @csrf
        <input type="hidden" name="packageId" id="packageId" value="{{$package->id}}">
        <div class="row">
            <div class="col-md mb-6">
                <h4>{{__('Edit package')}}</h4>
            </div>
            <div class="col-md"></div>
        </div>

        <div class="row mt-3">
            <div class="col-md mb-6">
                <label class="form-label" for="recipient-name">{{__('Name')}}</label>
                <input
                    class="form-control"
                    type="text"
                    name="recipient-name"
                    id="recipient-name"
                    value="{{$package->recipient->name}}"
                    required>
                @error('recipient-name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="col-md"></div>
        </div>

        <div class="row mt-3">
            <div class="col-md mb-6">
                <label class="form-label" for="recipient-phone_number">{{__('Phone number')}}</label>
                <input
                    class="form-control"
                    type="text"
                    name="recipient-phone_number"
                    id="recipient-phone_number"
                    value="{{$package->recipient->phone_number}}"
                    required
                >
                @error('recipient-phone_number')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="col-md"></div>
        </div>

        <div class="row mt-3">
            <div class="col-md mb-6">
                <label class="form-label" for="recipient-email">{{__('Email address')}}</label>
                <input
                    class="form-control"
                    type="email"
                    name="recipient-email"
                    id="recipient-email"
                    value="{{$package->recipient->email_address}}"
                    required
                >
                @error('recipient-email')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="col-md"></div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-md mb-6">
                        <label class="form-label" for="recipient-street">{{__('Street')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="recipient-street"
                            id="recipient-street"
                            value="{{$package->recipient->address->street}}"
                            required
                        >
                        @error('recipient-street')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md mb-6">
                                <label class="form-label" for="recipient-house_number">{{__('House number')}}</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="recipient-house_number"
                                    id="recipient-house_number"
                                    value="{{$package->recipient->address->house_number}}"
                                    required
                                >
                                @error('recipient-house_number')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="col-md mb-6">
                                <label class="form-label" for="recipient-addition">{{__('Addition')}}</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    name="recipient-addition"
                                    id="recipient-addition"
                                    value="{{$package->recipient->address->addition}}"
                                >
                                @error('recipient-addition')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md mb-6"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md mb-6">
                <div class="row">
                    <div class="col-md mb-6">
                        <label class="form-label" class="form-label"
                               for="recipient-postal_code">{{__('Postal code')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="recipient-postal_code"
                            id="recipient-postal_code"
                            value="{{$package->recipient->address->postal_code}}"
                            required
                        >
                        @error('recipient-postal_code')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md mb-6">
                        <label class="form-label" for="recipient-city">{{__('City')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="recipient-city"
                            id="recipient-city"
                            value="{{$package->recipient->address->city}}"
                            required
                        >
                        @error('recipient-city')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="col-md mb-6">
                        <label class="form-label" for="recipient-country">{{__('Country')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="recipient-country"
                            id="recipient-country"
                            value="{{$package->recipient->address->country}}"
                            required
                        >
                        @error('recipient-country')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md mb-6"></div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <label class="form-label" for="notes">{{__('Notes')}}</label>
                <textarea
                    class="form-control"
                    type="text"
                    name="notes"
                    id="notes"
                    cols="4"
                >{{$package->notes}}</textarea>
                @error('notes')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md"></div>
        </div>


        <input type="submit" class="btn btn-primary mt-3" value="{{__('Submit')}}">
    </form>
@endsection
