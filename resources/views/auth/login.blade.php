<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/template/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/template/dist/css/adminlte.min.css')}}">
</head>
<body style="background-color:lightblue;">
    @include('sweetalert::alert')
  <div class="container d-flex justify-content-center" style="margin-top:150px;">
        {{-- @if (session('success'))
          <div class="alert alert-success" role="alert">
            {{session('success')}}
          </div>
        @endif --}}
        <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Sign In</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Email</label>
                      <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                                    {{-- <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> --}}
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Password</label>
                      <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        @error('password')
                              <div class="alert alert-danger">{{ $message }}</div>
                                    {{-- <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> --}}
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-0 col-sm-10">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck2">
                          <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Sign in</button>
                    {{-- <button type="submit" class="btn btn-default float-right">Cancel</button> --}}
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
  </div>
 
<script src="{{asset('/template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/template/dist/js/adminlte.min.js')}}"></script>
</body>
</html>