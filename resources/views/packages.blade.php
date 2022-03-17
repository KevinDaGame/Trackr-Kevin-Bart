@extends('layout')
@section('title')
    <title>Packages</title>
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
            <th scope="col">Id</th>
            <th scope="col">Sender</th>
            <th scope="col">Recipient</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
                <tr class="table-primary">
                    <th scope="row">{{$package->id}}</th>
                    <td>{{$package->sender->name}}</td>
                    <td>{{$package->recipient ?? false ? $package->recipient->fullName() : ''}}</td>
                    <td>{{$package->status}}</td>
                    <td><form method="GET" action="/generate-pdf"><button type="submit" class="btn btn-primary btn-sm" value="{{ $package->id }}">Download als pdf</button></form></td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
