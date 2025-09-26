<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>ERP Systems</title>

  {{-- CSRF for AJAX --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Vendor CSS --}}
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/select2/dist/css/select2.min.css') }}">

  {{-- Template CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/bundles/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/custom.css') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/assets/img/logo.png') }}" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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
  {{-- Hidden logout form (used by menu) --}}
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
  </form>

  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      {{-- NAVBAR --}}
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
              <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                <i data-feather="align-justify"></i>
              </a>
            </li>
            <li>
              <h3 class="m-0 nav-link nav-link-lg text-dark">
                @yield('page-title', '')
              </h3>
            </li>
          </ul>
        </div>

        <ul class="navbar-nav navbar-right">
          <li><a href="#" class="nav-link nav-link-lg fullscreen-btn"><i data-feather="maximize"></i></a></li>
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
              <i data-feather="bell" class="bell"></i>
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifications
                <div class="float-right"><a href="#">Mark All As Read</a></div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <span class="dropdown-item-icon bg-primary text-white"><i class="fas fa-code"></i></span>
                  <span class="dropdown-item-desc">Template update is available now! <span class="time">2 Min Ago</span></span>
                </a>
                <a href="#" class="dropdown-item">
                  <span class="dropdown-item-icon bg-info text-white"><i class="far fa-user"></i></span>
                  <span class="dropdown-item-desc"><b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <span class="time">10 Hours Ago</span></span>
                </a>
              </div>
              <div class="dropdown-footer text-center"><a href="#">View All <i class="fas fa-chevron-right"></i></a></div>
            </div>
          </li>

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="{{ asset('assets/admin/assets/img/user.png') }}" class="user-img-radious-style">
              <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello</div>
              <a href="{{ route('profile') }}" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
              <a href="#" class="dropdown-item has-icon text-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      {{-- SIDEBAR --}}
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ url('/') }}">
              <img alt="image" src="{{ asset('assets/admin/assets/img/logo.png') }}" class="header-logo" />
              <span class="logo-name"></span>
            </a>
          </div>

          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>

            {{-- Dashboard --}}
            <li class="dropdown {{ request()->routeIs('home') ? 'active' : '' }}">
              <a href="{{ route('home') }}"
                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-desktop"></i><span>Dashboard</span>
              </a>
            </li>

            {{-- Orders (covers /order and all order* named routes) --}}
            <li class="dropdown {{ request()->routeIs('order*') || request()->routeIs('orders.*') ? 'active' : '' }}">
              <a href="{{ route('order') }}"
                class="nav-link {{ request()->routeIs('order*') || request()->routeIs('orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i><span>Orders</span>
              </a>
            </li>

            {{-- Profile --}}
            <li class="dropdown {{ request()->routeIs('profile') ? 'active' : '' }}">
              <a href="{{ route('profile') }}"
                class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="far fa-user"></i><span>Profile</span>
              </a>
            </li>

            {{-- Admin-only links (hidden for non-admins) --}}
            @if (auth()->user()?->isAdmin())
            {{-- Order Detay --}}
            <li class="dropdown {{ request()->routeIs('orderdetay*') ? 'active' : '' }}">
              <a href="{{ route('orderdetay') }}"
                class="nav-link {{ request()->routeIs('orderdetay*') ? 'active' : '' }}">
                <i class="fas fa-list-alt"></i><span>Orders Detay</span>
              </a>
            </li>

            {{-- Offers --}}
            <li class="dropdown {{ request()->routeIs('offer.*') ? 'active' : '' }}">
              <a href="{{ route('offer.index') }}"
                class="nav-link {{ request()->routeIs('offer.*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice-dollar"></i><span>Offers</span>
              </a>
            </li>

            {{-- Users --}}
            <li class="dropdown {{ request()->routeIs('user.*') ? 'active' : '' }}">
              <a href="{{ route('user.index') }}"
                class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                <i class="fas fa-user-cog"></i><span>Users</span>
              </a>
            </li>
            @endif
          </ul>

        </aside>
      </div>

      {{-- PAGE CONTENT --}}
      @yield('content')

      <footer class="main-footer" style="    align-items: center;
    /* justify-items: center; */
    align-content: center;
    display: flex
;
    justify-content: space-between;">
        <div class="footer-left"><a href="/"><img
              width="100"
              alt="image" src="{{ asset('assets/admin/assets/img/logo.png') }}" class="header-logo" /></a></div>
        <div class="footer-right">2025-26</div>
      </footer>
    </div>
  </div>

  {{-- ====== JS (Order matters) ====== --}}
  {{-- 1 jQuery (CDN + fallback) --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="{{ asset("assets / admin / assets / bundles / jquery / jquery.min.js ") }}"><\/script>')
  </script>

  {{-- 2 Cleave (CDN + fallback) --}}
  <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
  <script>
    window.Cleave || document.write('<script src="{{ asset("assets / admin / assets / bundles / cleave - js / cleave.min.js ") }}"><\/script>')
  </script>

  {{-- 3) jQuery UI (requires jQuery) --}}
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

  {{-- 4) Moment + Daterangepicker --}}
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

  {{-- 5) Select2 --}}
  <script src="{{ asset('assets/admin/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>

  {{-- 6) Theme / Bootstrap base --}}
  <script src="{{ asset('assets/admin/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/js/custom.js') }}"></script>

  {{-- 7) Other plugins already in your project (optional) --}}
  <script src="{{ asset('assets/admin/assets/bundles/chartjs/chart.min.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/bundles/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/bundles/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/bundles/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/bundles/jqvmap/dist/maps/jquery.vmap.indonesia.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/js/page/advance-table.js') }}"></script>
  <script src="{{ asset('assets/admin/assets/js/page/widget-chart.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  {{-- 8) Global helpers + init --}}
  <script>
    // AJAX CSRF for all jQuery calls
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      }
    });

    // Global Select2 default
    $(function() {
      $('.select2').select2({
        width: '100%',
        placeholder: 'Seçiniz',
        allowClear: true
      });
    });

    // Example Cleave usage (attach to any number field by class)
    // new Cleave('.money', { numeral: true, numeralDecimalMark: ',', delimiter: '.' });
  </script>

  {{-- Page-specific scripts injected by @push('scripts') --}}
  @stack('scripts')
</body>

</html>