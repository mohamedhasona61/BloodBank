<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Bank</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <p>Blood Bank </p>
  
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"></ul>  
  </nav>
  <!-- /navbar -->
   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{asset('adminlte/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">BloodBank</span>
    </a> 

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('adminlte/img/Hasona.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
       <ul class="sidebar-menu" data-widget="tree">
      
         <li><a href="{{url(route('categories.index'))}}"><i class="fa fa-list"></i><span>Categories</span></a></li>
         <li><a href="{{url(route('posts.index'))}}"><i class="fa fa-list"></i><span>Posts</span></a></li>
         <li><a href="{{url(route('governorate.index'))}}"><i class="fa fa-list"></i><span>Governorates</span></a></li>
         <li><a href="{{url(route('cities.index'))}}"><i class="fa fa-list"></i><span>Cities</span></a></li>
         <li><a href="{{url(route('donationRequest.index'))}}"><i class="fa fa-list"></i><span>Donations Requests</span></a></li>
         <li><a href="{{url(route('contacts.index'))}}"><i class="fa fa-list"></i><span>Contact Us</span></a></li>
         <li><a href="{{url(route('role.index'))}}"><i class="fa fa-list"></i><span>Roles</span></a></li>
         <li><a href="{{url(route('user.index'))}}"><i class="fa fa-list"></i><span>Users</span></a></li>
         <li><a href="{{url(route('appSettings.index'))}}"><i class="fa fa-list"></i><span>Settings</span></a></li>
         <li><a href="{{url(route('client.index'))}}"><i class="fa fa-list"></i><span>Clients</span></a></li>

       

       </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside> --}}

 @yield('content')

  <footer class="main-footer">
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admillte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>
@stack('scripts')
</body>
</html>
