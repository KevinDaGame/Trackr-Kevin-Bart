@extends('layout')
@section('title')
    <title>{{__('Register')}}</title>
@endsection()
@section('body')
    <main class="mt-5 text-center mx-auto w-75 bg-light border border-dark rounded-2">
        <h1>{{__('Add employee')}}</h1>

        <form action="/addemployee" method="POST" class="mt-5 p-3">
            @csrf
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
            <div class="row mb-2">
                <div class="col-md">
                    <label for="role">Selecteer de rol:</label>
                    <select name="role" id="role" class="form-control">
                        @foreach($roles as $role)
                            @if($role == "Admin" || $role == "Packer")
                                <option value="{{ $role }}" {{ ( $role == request('role')) ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md"></div>

            </div>
            <input type="submit" class="btn btn-primary m-6" value="{{__('Submit')}}">
        </form>
    </main>
@endsection()
