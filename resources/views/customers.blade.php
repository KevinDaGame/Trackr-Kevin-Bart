@extends('layout')
@section('title')
    <title>Customers</title>
@endsection
@section('body')
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
                    <td>{{ $customer->fullName() }}</td>
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
