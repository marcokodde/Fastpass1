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
            <th>STOCK</th>
            <th>VIN</th>
            <th>GRADE</th>
            <th>NEXT TIER</th>
        </thead>
        <tbody>
            @foreach ($records as $record )
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$record['stock']}}</td>
                    <td>{{$record['vin']}}</td>
                    <td>{{$record['grade']}}</td>
                    <td align="right">{{number_format($record['additionalDownpaymentForNextTier'],2)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
