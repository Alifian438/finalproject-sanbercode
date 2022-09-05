<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cetak</title>
</head>
<body>
    <table align="center" rules="all" border="1px" style="width= 95%;">
        <tr>
            <th>No</th>
            <th>Nama</th>
        </tr>
        @foreach ($kategori as $item)
        <tr>
            <th>{{$item->id}}</th>
            <th>{{$item->nama}}</th>
        </tr>    
        @endforeach
    </table>
</body>
</html>
    
    
