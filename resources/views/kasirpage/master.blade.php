<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="{{asset('LOGO.jpg')}}">
  <title>Nama Apotek | {{ auth()->user()->name }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{asset('parsley/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('select2/select2.css')}}">

  <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> -->
  

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
    <div class="container">
      <a href="{{url('kasirpage')}}" class="navbar-brand">
        <img src="" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{url('kasirpage')}}" class="nav-link {{Request::is('kasirpage*') ? 'active' : ''}}"><i class="fas fa-home"></i> Home</a>
          </li>
          <li class="nav-item">
            <a href="{{url('riwayat-penjualan')}}" class="nav-link {{Request::is('riwayat-penjualan*') ? 'active' : ''}}"><i class="fas fa-history"></i> Riwayat Penjualan</a>
          </li>
          <li class="nav-item">
            <a href="{{url('info-obat')}}" class="nav-link {{Request::is('info-obat*') ? 'active' : ''}}"><i class="fas fa-info"></i> Informasi Obat</a>
          </li>
          <li class="nav-item">
            <a href="{{url('info-pelanggan')}}" class="nav-link {{Request::is('info-pelanggan*') ? 'active' : ''}}"><i class="fas fa-users"></i> Pelanggan</a>
          </li>
        </ul>
        

      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle {{Request::is('kasir/profile*') ? 'active' : ''}}"><i class="fas fa-user"></i> {{ auth()->user()->name }}</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="{{url('kasir/profile')}}" class="dropdown-item"><i class="fas fa-user"></i> Profile</a></li>
            <li><a href="{{url('logout')}}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></a></li>

          
           
            <!-- End Level two -->
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->
<br>
<section class="content">
 @yield('content')
</section>
  
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->
<!-- AdminLTE -->
<script src="{{asset('select2/select2.js')}}"></script>

<script src="{{asset('parsley/parsley.js')}}"></script>
<script src="{{asset('parsley/parsley.min.js')}}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
@yield('javaScript')
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<script>
  function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
<script>
  $(function() {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
   });

  //  TOAST Type = info,error,warning,success,question
  @if(session('FlashSukses'))
    Toast.fire({
      type: 'success',
      title: '{{session('FlashSukses')}}'
    });

  @endif
  @if(session('FlashError'))
    Toast.fire({
      type: 'error',
      title: '{{session('FlashError')}}'
    });

  @endif

  });
 

</script>
</body>
</html>
