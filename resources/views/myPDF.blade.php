<!DOCTYPE html>
<html>
<head>
    <title>Label</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<p>{{ $date }}</p>

<div class="border p-3">
    <h1>Verzender</h1>
    <table>
        <tr>
            <td>{{ $package->sender->name }}</td>
        </tr>
        <tr>
            <td>{{ $package->sender->address->street . ' ' . $package->sender->address->house_number
            . $package->sender->address->addition }}</td>
        </tr>
        <tr>
            <td>{{ $package->sender->address->city . ' ' . $package->sender->address->postal_code }}</td>
        </tr>
    </table>
</div>

<div class="border p-3 mt-3">
    <h1>Ontvanger</h1>
    <table>
        <tr>
            <td>{{ $package->recipient->fullname() }}</td>
        </tr>
        <tr>
            <td>{{ $package->recipient->address->street . ' ' . $package->recipient->address->house_number
            . $package->recipient->address->addition }}</td>
        </tr>
        <tr>
            <td>{{ $package->recipient->address->city . ' ' . $package->recipient->address->postal_code }}</td>
        </tr>
    </table>
</div>

<div class="border p-3 mt-3">
    <h3>Track & Trace code:</h3>
    <p>{{$package->id}}</p>
    <h3>Barcode:</h3>
    {!! $barcode !!}
</div>

</body>
</html>
