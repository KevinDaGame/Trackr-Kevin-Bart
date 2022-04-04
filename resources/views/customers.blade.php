@extends('layout')
@section('title')
    <title>Customers</title>
@endsection
@section('body')
    <form method="GET" action="#">
        <div class="d-flex justify-content-center">
            <div class="m-1">
                <label for="nameSearch">Zoek een klant:</label>
                <input
                    id="nameSearch"
                    type="text"
                    name="name"
                    placeholder="zoeken op naam"
                    value="{{ request('name') }}"
                    class="form-control">
            </div>
            <div class="m-1">
                <label for="country">Selecteer het land:</label>
                <select name="country" id="country" class="form-control">
                    <option></option>
                    @foreach($countries as $country)
                        <option value="{{ $country }}" {{ ( $country == request('country')) ? 'selected' : '' }}>
                            {{ $country }}
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
                <th>Naam</th>
                <th>Email</th>
                <th>Telefoon</th>
                <th>Straat</th>
                <th>Huisnummer</th>
                <th>Postcode</th>
                <th>Plaats</th>
                <th>Land</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr class="table-primary">
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email_address }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ $customer->address->street }}</td>
                    <td>{{ $customer->address->house_number . $customer->address->addition }}</td>
                    <td>{{ $customer->address->postal_code }}</td>
                    <td>{{ $customer->address->city }}</td>
                    <td>{{ $customer->address->country }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
