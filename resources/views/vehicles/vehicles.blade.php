<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VEHICULOS</title>
</head>
<body>
    <table border="1">
        <thead>
            <th>No</th>
            <th>Dealer</th>
            <th>VIN</th>
            <th>VIN</th>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>AÑO</th>
            <th>COLOR</th>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle )
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$vehicle['dealer_id']}}</td>
                    <td>{{$vehicle['vin']}}</td>
                    <td>{{$vehicle['year']}}</td>
                    <td>{{$vehicle['make']}}</td>
                    <td>{{$vehicle['model']}}</td>
                    <td>{{$vehicle['exterior_color']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
