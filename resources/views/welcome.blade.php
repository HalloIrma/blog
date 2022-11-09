<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/template/dist/css/adminlte.min.css')}}">
    <title>Document</title>
</head>
<body style="background-image: url({{asset('/template/dist/img/bg.png')}}); background-repeat:no-repeat;background-size:cover;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            {{-- <a class="navbar-brand" href="#">Navbar</a> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <ul class="navbar-nav ml-auto">
                <a href="/register" style="margin-right: 20px;">Register</a>
                <a href="/login" style="margin-right: 20px;">Login</a>
            </ul>
            
          </nav>
</body>
</html>