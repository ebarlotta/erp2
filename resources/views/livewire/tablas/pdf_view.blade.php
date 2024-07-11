<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body style="font-family: Arial, Helvetica, sans-serif; ">
    <table style="font-size: 16px;">
        <tr>
            <td><img src="{{ $url_logo_empresa  }}" alt="" width="60px;"></td>
            <td><h2>{{ $nombre_empresa }}</h2></td>
        </tr>
    </table>
    
    {!! $html !!}

</body>

</html>
