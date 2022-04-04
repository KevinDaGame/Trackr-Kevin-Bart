@extends('layout')
@section('title')
    <title>{{__('Add webshop')}}</title>
@endsection()
@section('body')
    <main class="mt-5 text-center mx-auto w-75 bg-light border border-dark rounded-2">
        <h1>{{__('Add webshop')}}</h1>

        <form action="/addwebshop" method="POST" class="p-3">
            @csrf
            <legend class="mt-1">{{__('Login information')}}</legend>
            <div class="row">
                <div class="col-md mb-2">
                    <label class="form-label" for="first-name">{{__('First name')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="first-name"
                        id="first-name"
                        value="{{old('first-name')}}"
                        required
                    >
                    @error('first-name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md mb-2">
                    <label class="form-label" for="last-name">{{__('Last name')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="last-name"
                        id="last-name"
                        value="{{old('last-name')}}"
                        required
                    >
                    @error('last-name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label" for="email">{{__('Email address')}}</label>
                <input
                    class="form-control"
                    type="email"
                    name="email"
                    id="email"
                    value="{{old('email')}}"
                    required
                >
                @error('email')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label" for="password">{{__('Password')}}</label>
                <input
                    class="form-control"
                    type="password"
                    name="password"
                    id="password"
                    value="{{old('password')}}"
                    required
                >
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <legend class="mt-1">{{__('Company information')}}</legend>
            <div class="row mt-3">
                <div class="col-md mb-2">
                    <label for="company-name" class="form-label">{{__('Company name')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="company-name"
                        id="company-name"
                        value="{{old('company-name')}}"
                        required
                    >
                    @error('company name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md mb-2">
                    <label class="form-label" for="country">{{__('Country')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="country"
                        id="country"
                        value="{{old('country')}}"
                        required
                    >
                    @error('country')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md mb-2">
                    <label class="form-label" for="city">{{__('City')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="city"
                        id="city"
                        value="{{old('city')}}"
                        required
                    >
                    @error('city')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-2">
                    <label class="form-label" for="street">{{__('Street')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="street"
                        id="street"
                        value="{{old('street')}}"
                        required
                    >
                    @error('street')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md mb-2">
                    <label class="form-label" class="form-label" for="postal_code">{{__('Postal code')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="postal_code"
                        id="postal_code"
                        value="{{old('postal_code')}}"
                        required
                    >
                    @error('postal_code')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md mb-2">
                    <label class="form-label" for="house_number">{{__('House number')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="house_number"
                        id="house_number"
                        value="{{old('house_number')}}"
                        required
                    >
                    @error('house_number')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md">
                    <label class="form-label" for="addition">{{__('Addition')}}</label>
                    <input
                        class="form-control"
                        type="text"
                        name="addition"
                        id="addition"
                        value="{{old('addition')}}"
                    >
                    @error('addition')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <input type="submit" class="btn btn-primary m-6" value="{{__('Submit')}}">
        </form>
    </main>
@endsection()
