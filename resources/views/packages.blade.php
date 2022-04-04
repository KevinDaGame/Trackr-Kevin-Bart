@extends('layout')
@section('title')
    <title>{{__('Packages')}}</title>
@endsection
@section('body')
    <form method="GET" action="#">
        <div class="d-flex justify-content-center">
            <div class="m-1">
                <label for="sender">Zoek een zender:</label>
                <input
                    id="sender"
                    type="text"
                    name="sender"
                    placeholder="zoek een zender"
                    value="{{ request('sender') }}"
                    class="form-control">
            </div>
            <div class="m-1">
                <label for="receiver">Zoek een ontvanger:</label>
                <input
                    id="receiver"
                    type="text"
                    name="receiver"
                    placeholder="zoek een ontvanger"
                    value="{{ request('receiver') }}"
                    class="form-control">
            </div>
            <div class="m-1">
                <label for="status">Selecteer de status:</label>
                <select name="status" id="status" class="form-control">
                    <option></option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ ( $status == request('status')) ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-auto m-1">
                <button type="submit" class="btn btn-primary">Zoeken</button>
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
        <tr>
            <th></th>
            <th scope="col">Id</th>
            <th scope="col">Sender</th>
            <th scope="col">Recipient</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <form method="GET" action="generate-pdfs" id="selected-packages">
            <tbody>
            @foreach($packages as $package)
                <tr class="table-primary">
                    <td><input type="checkbox" name="dl{{$package->id}}" value="{{$package->id}}"></td>
                    <th scope="row">{{$package->id}}</th>
                    <td>{{$package->sender->name}}</td>
                    <td>{{$package->recipient ?? false ? $package->recipient->name : ''}}</td>
                    <td>{{$package->status}}</td>
                    <td>
                        <a href="/generate-pdf?id={{$package->id}}">Download als pdf</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </form>
    </table>
    <button type="submit" class="btn btn-primary btn-sm" form="selected-packages">Download geselecteerde orders als pdf</button>
@endsection
