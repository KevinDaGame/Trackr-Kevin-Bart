<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Customers</title>
</head>
<body>
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
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phoneNumber }}</td>
                    <td>{{ $customer->address->street }}</td>
                    <td>{{ $customer->address->houseNumber + $customer->address->addition }}</td>
                    <td>{{ $customer->address->postalCode }}</td>
                    <td>{{ $customer->address->city }}</td>
                    <td>{{ $customer->address->country }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
