@extends('layout')
@section('title')
    <title>{{__('Register')}}</title>
@endsection()
@section('body')
    <main class="mt-5 text-center mx-auto w-75 bg-light border border-dark rounded-2">
        <h1>Register</h1>
        <form action="/register" method="POST" class="mt-5 p-3">

            <div class="mb-6">
                <label for="first-name">{{__('First name')}}</label>
                <input
                    type="text"
                    name="first-name"
                    id="first-name"
                    required
                >
                @error('first-name')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="middle-name">{{__('Middle name')}}</label>
                <input
                    type="text"
                    name="middle-name"
                    id="middle-name"
                    required
                >
                @error('middle-name')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="last-name">{{__('Last name')}}</label>
                <input
                    type="text"
                    name="last-name"
                    id="last-name"
                    required
                >
                @error('last-name')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="email">{{__('Email address')}}</label>
                <input
                    type="text"
                    name="email"
                    id="email"
                    required
                >
                @error('email')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="phone-number">{{__('Phone number')}}</label>
                <input
                    type="text"
                    name="phone-number"
                    id="phone-number"
                    required
                >
                @error('phone-number')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="city">{{__('City')}}</label>
                <input
                    type="text"
                    name="city"
                    id="city"
                    required
                >
                @error('city')
                <p class="text-red">{{$message}}</p>
                @enderror
                <div class="mb-6">
                    <label for="country">{{__('Country')}}</label>
                    <input
                        type="text"
                        name="country"
                        id="country"
                        required
                    >
                    @error('country')
                    <p class="text-red">{{$message}}</p>
                    @enderror
                </div>

            </div>
            <div class="mb-6">
                <label for="street">{{__('Street')}}</label>
                <input
                    type="text"
                    name="street"
                    id="street"
                    required
                >
                @error('street')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="postal_code">{{__('Postal code')}}</label>
                <input
                    type="text"
                    name="postal_code"
                    id="postal_code"
                    required
                >
                @error('postal_code')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="house_number">{{__('House number')}}</label>
                <input
                    type="text"
                    name="house_number"
                    id="house_number"
                    required
                >
                @error('house_number')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="addition">{{__('Addition')}}</label>
                <input
                    type="text"
                    name="addition"
                    id="addition"
                    required
                >
                @error('addition')
                <p class="text-red">{{$message}}</p>
                @enderror
            </div>


            <input type="submit">
        </form>
    </main>
@endsection()
