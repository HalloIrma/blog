<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connected</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="{{asset('/template/plugins/fontawesome-free/css/all.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('/template/plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/template/dist/css/adminlte.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('/template/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

</head>
<body class="layout-boxed" style="background-color:lightblue">
<!-- Site wrapper -->
<div class="wrapper">
 
   
      <!-- Navbar -->
      @include('partial.nav')

      <div class="row">
        <div class="col-sm-2">
           @include('partial.aside')
        </div>
        <div class="col-md">
          @include('partial.nav2')
          @yield('content')
             
        </div>
      </div>
      <div class="row" style="height:2.5rem">
      </div>
      <!-- /.navbar -->
      <!-- Content Wrapper. Contains page content -->
      
  </div>
  <!-- /.content-wrapper -->
  
<footer style="background-color:white; position:fixed; bottom:0px; left:0px; width:100%; height:2.5rem">

    <div style="float:right;">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Connected.Meta</a>.</strong> All rights reserved.

</footer>


<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('/template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/template/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('/template/dist/js/demo.js')}}"></script> --}}
<!-- input mask -->
<script src="{{asset('/template/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('/template/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- bs-custom-file-input -->
{{-- <script src="{{asset('/template/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script> --}}
<script>
    $(function () {
       //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
      //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    });

</script>
@stack('notifupdate')
{{-- <script>
    $(function () {
      bsCustomFileInput.init();
    });
    </script> --}}
</body>
</html>
