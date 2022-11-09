<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/template/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/template/dist/css/adminlte.min.css')}}">
</head>
<body style="background-color:lightblue;">

 
  <div class="container d-flex justify-content-center" style="margin-top:80px;">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Sign Up!</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('register') }}" >
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="Firstname">First Name</label>
                  <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter ..." required>
                </div>
              </div>
              <div class="col">
                  <div class="form-group">
                    <label for="Lastname">Last Name</label>
                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter ..." required>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" >
              @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" required>
              @error('pwd')
                  <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
            {{-- <div class="form-group">
              <label for="exampleInputFile">Upload your photo profile!</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                </div>
              </div>
            </div> --}}
            {{-- <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> --}}
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>

        <div class="card-body">
          <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="/login" class="btn btn-block btn-primary">
              <i class="fas fa-sign-in-alt mr-2"></i> Sign in here!
            </a>
          </div>
        </div>
         
      </div>
    </div>
    

 
<script src="{{asset('/template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/template/dist/js/adminlte.min.js')}}"></script>
</body>
</html>