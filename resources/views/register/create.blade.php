@extends('layout')
@section('title')
    <title>{{__('Register')}}</title>
@endsection()
@section('body')
    <main class="mt-5 text-center mx-auto w-75 bg-light border border-dark rounded-2">
        <h1>{{__('Register')}}</h1>

        <form action="/register" method="POST" class="mt-5 p-3">
            @csrf
            <div class="row">
                <div class="col-md mb-6">
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
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md mb-6">
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
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
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
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
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
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="form-label" for="phone-number">{{__('Phone number')}}</label>
                <input
                    class="form-control"
                    type="text"
                    name="phone-number"
                    id="phone-number"
                    value="{{old('phone-number')}}"
                    required
                >
                @error('phone-number')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <legend class="mt-4">{{__('Address')}}</legend>
            <div class="row mt-3">
                <div class="col-md mb-6">
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
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md mb-6">
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
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-6">
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
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>

                <div class="col-md mb-6">
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
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md mb-6">
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
                    <p class="text-red">{{$message}}</p>
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
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <input type="submit" class="btn btn-primary m-6" value="{{__('Submit')}}">
        </form>
    </main>

    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endsection()
