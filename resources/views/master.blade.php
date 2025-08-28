<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>ERP Systems</title>
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/app.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/flag-icon-css/css/flag-icon.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/components.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{asset('assets/admin/assets/img/favicon.ico')}}" />
  {{-- <script src="{{asset('assets/admin/assets/js/auth.js')}}" defer></script> --}}

 
    <!-- Template CSS -->
    <!-- Custom style CSS -->
</head>
<style>
    span.select2 {
        width: 100% !important;
    }

    .modal-body .row input {
        height: 42px !important;
    }
</style>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                            collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li>
              <h3 class="m-0 nav-link nav-link-lg text-dark">DASHBOARD</h3>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
              <i data-feather="maximize"></i>
            </a>
          </li>
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
              <i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                    class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-code"></i>
                  </span> <span class="dropdown-item-desc"> Template update is
                    available now! <span class="time">2 Min
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="far
												fa-user"></i>
                  </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                      Sugiharto</b> are now friends <span class="time">10 Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i
                      class="fas
												fa-check"></i>
                  </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                    moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                      Hours
                      Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i
                      class="fas fa-exclamation-triangle"></i>
                  </span> <span class="dropdown-item-desc"> Low disk space. Let's
                    clean it! <span class="time">17 Hours Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
												fa-bell"></i>
                  </span> <span class="dropdown-item-desc"> Welcome to Otika
                    template! <span class="time">Yesterday</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{asset('assets/admin/assets/img/user.png')}}"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello Sarah Smith</div>
              <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a>
              <a type="button" onclick="logout()" class="dropdown-item has-icon text-danger"> <i
                  class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="{{asset('assets/admin/assets/img/logo.png')}}" class="header-logo" /> <span
                class="logo-name"></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
              <a href="{{url('/')}}" class="nav-link">
                <i class="fas fa-desktop"></i>
                <span>Dashboard</span></a>
            </li>
            <li class="dropdown ">
              <a href="{{url('order')}}" class="nav-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span></a>
            </li>
            <li class="dropdown">
              <a href="{{url('user')}}" class="nav-link">
                <i class="fas fa-user"></i>
                <span>Users</span></a>
            </li>
          </ul>
        </aside>
      </div>

      @yield('content')

      <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Templateshub</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('assets/admin/assets/js/app.min.js')}}"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />

  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <!-- JS Libraies -->
  <script src="{{asset('assets/admin/assets/bundles/chartjs/chart.min.js')}}"></script>
  <script src="{{asset('assets/admin/assets/bundles/jquery.sparkline.min.js')}}"></script>
  <script src="{{asset('assets/admin/assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/admin/assets/bundles/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('assets/admin/assets/bundles/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('assets/admin/assets/bundles/jqvmap/dist/maps/jquery.vmap.indonesia.js')}}"></script>
  <script src="{{asset('assets/admin/assets/js/page/advance-table.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('assets/admin/assets/js/page/widget-chart.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{asset('assets/admin/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{asset('assets/admin/assets/js/custom.js')}}"></script>

  <script>
    $(function () {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function (start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      });
    });
  </script>

</body>
</html>