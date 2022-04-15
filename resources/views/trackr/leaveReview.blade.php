@extends('layout')
@section('title')
    <title>{{__("Leave a review")}}</title>
@endsection
@section('body')
    <h1>{{__("Leave a review")}}</h1>
    <form action="send" method="POST">
        <input type="hidden" name="trace-code" id="trace-code" value="{{$package->id}}">
        @error('trace-code')
        <p class="text-danger">{{$message}}</p>
        @enderror
        @csrf
        <textarea name="review" id="review" cols="30" rows="10"class="form-control"></textarea>
        @error('review')
        <p class="text-danger">{{$message}}</p>
        @enderror
        <button type="submit" class="btn btn-primary m-2">{{__('Submit')}}</button>
    </form>

@endsection
