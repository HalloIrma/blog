<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
            table, th, td {
              border: 1px solid black;
            }
            </style>
    <title>Table data</title>
</head>
<body>
    <h1>Data yang diinputkan</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Gender</th>
        </tr>
        <tr>
            <td>{{$nama}}</td>
            <td>{{$alamat}}</td>
            <td>{{$email}}</td>
            <td>{{$hp}}</td>
            <td>{{$gender}}</td>
        </tr>
    </table>
</body>
</html>