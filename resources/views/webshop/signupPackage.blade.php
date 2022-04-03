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
                <label class="form-label" for="recipient-name">{{__('Name')}}</label>
                <input
                    class="form-control"
                    type="text"
                    name="recipient-name"
                    id="recipient-name"
                    value="{{old('recipient-name')}}"
                    required>
                @error('recipient-name')
                <p class="text-danger">{{$message}}</p>
                @enderror
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
                <label class="form-label" for="recipient-phone_number">{{__('Phone number')}}</label>
                <input
                    class="form-control"
                    type="text"
                    name="recipient-phone_number"
                    id="recipient-phone_number"
                    value="{{old('recipient-phone_number')}}"
                    required
                >
                @error('recipient-phone_number')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <div class="row">
                    <div class="col-md mb-6">
                        <label class="form-label" class="form-label"
                               for="sender-postal_code">{{__('Postal code')}}</label>
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
                <label class="form-label" for="recipient-email">{{__('Email address')}}</label>
                <input
                    class="form-control"
                    type="email"
                    name="recipient-email"
                    id="recipient-email"
                    value="{{old('recipient-email')}}"
                    required
                >
                @error('recipient-email')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md mb-6"></div>

            <div class="col">
                <div class="row">
                    <div class="col-md mb-6">
                        <label class="form-label" for="recipient-street">{{__('Street')}}</label>
                        <input
                            class="form-control"
                            type="text"
                            name="recipient-street"
                            id="recipient-street"
                            value="{{old('recipient-street')}}"
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
                                    value="{{old('recipient-house_number')}}"
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
                                    value="{{old('recipient-addition')}}"
                                >
                                @error('recipient-addition')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md mb-6"></div>

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
                            value="{{old('recipient-postal_code')}}"
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
                            value="{{old('recipient-city')}}"
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
                            value="{{old('recipient-country')}}"
                            required
                        >
                        @error('recipient-country')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
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
                >{{old('notes')}}</textarea>
                @error('notes')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md"></div>
        </div>

        <input type="submit" class="btn btn-primary mt-3" value="{{__('Submit')}}">
    </form>

    <form class="mt-1 p-3" method="POST" action="/importcsv" enctype="multipart/form-data">
        @csrf
        <label class="form-label" for="csv_file">CSV:</label>
        <input
            type="file"
            id="csv_file"
            class="form-control"
            name="csv_file"
            accept=".csv"
            required
        >
        @error('csv_file')
        <p class="text-danger">{{$message}}</p>
        @enderror

        <input type="submit" class="btn btn-primary mt-3" value="{{__('Submit')}}">
    </form>
@endsection
