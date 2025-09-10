<!DOCTYPE html>
<html lang="en">

<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Sunset</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/app.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/assets/bundles/bootstrap-social/bootstrap-social.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('assets/admin/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{asset('assets/admin/assets/img/logo.png')}}" />

  <script src="{{asset('assets/admin/assets/js/auth.js')}}" defer></script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div style="display: flex; justify-content: center; margin-bottom: 20px;">
          <img alt="name" src="assets/admin/assets/img/logo.png" width="300" />
        </div>
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <!-- FIXED -->
                <form id="loginForm" method="POST" action="{{ route('login.post') }}">
                  @csrf
                  <div class="form-group">
                    <label>Email or Username</label>
                    <input name="email" class="form-control" value="" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" value="" required>
                  </div>
                  <button class="btn btn-primary btn-lg btn-block">Login</button>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('assets/admin/assets/js/app.min.js')}}"></script>
  <script src="{{asset('assets/admin/assets/js/scripts.js')}}"></script>
  <script src="{{asset('assets/admin/assets/js/custom.js')}}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const f = document.getElementById('loginForm');
      if (!f) return;

      f.addEventListener('submit', async (e) => {
        e.preventDefault();

        const tokenTag = document.querySelector('meta[name="csrf-token"]');
        const csrf = tokenTag ? tokenTag.content : null;
        if (!csrf) {
          // fallback: do a normal form submit if meta is missing
          f.submit();
          return;
        }

        const body = new URLSearchParams(new FormData(f));

        const res = await fetch(f.action, {
          method: 'POST',
          credentials: 'same-origin', // IMPORTANT for session cookies
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrf,
            'Accept': 'text/html,application/json'
          },
          body
        });

        if (res.status === 419) {
          alert('Session expired / CSRF mismatch');
          return;
        }
        if (res.redirected) {
          location.assign(res.url);
          return;
        }
        if (res.ok) {
          location.assign('{{ route("home") }}');
          return;
        }

        const text = await res.text();
        console.error('Login failed', res.status, text);
        alert('Login failed');
      });
    });
  </script>

</body>



</html>