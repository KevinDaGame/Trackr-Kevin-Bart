@extends('layout')
@section('title')
    <title>Register</title>
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
                <label for="middle-name">Middle name</label>
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
                <label for="last-name">Last name</label>
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


            <input type="submit">
        </form>
    </main>
@endsection()
