@extends('layout')
@section('title')
    <title>{{__('login')}}</title>
@endsection
@section('body')
    <main class="mt-5 text-center mx-auto bg-light border border-dark rounded-2">
        <h1>{{__('Login')}}</h1>

        <form action="/login" method="POST" class="mt-1 p-3">
            @csrf
            <div class="col-md mb-3">
                <label class="form-label" for="email">{{__('Email address')}}</label>
                <input
                    class="form-control"
                    type="text"
                    name="email"
                    id="email"
                    value="{{old('email')}}"
                    required
                >
                @error('email')
                <p class="text-danger">{{__($message)}}</p>
                @enderror
            </div>
            <div class="col-md mb-3">
                <label class="form-label" for="password">{{__('Password')}}</label>
                <input
                    class="form-control"
                    type="password"
                    name="password"
                    id="password"
                    required
                >
                @error('password')
                <p class="text-danger">{{__($message)}}</p>
                @enderror
            </div>

            <input type="submit" class="btn btn-primary" value="{{__('Submit')}}">

        </form>
    </main>
@endsection
