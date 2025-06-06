<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left" data-sidebar-behavior="sticky">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
  <meta name="author" content="Bootlab">

  <title>Reset Password</title>

  <link rel="shortcut icon" href="img/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet">
  <script src="{{ asset('admin') }}/assets/js/settings.js"></script>
</head>

<body>
  <div class="auth-full-page d-flex">
    <div class="auth-form p-3">

      <div class="text-center">
        <h1 class="h2">Reset Your Password</h1>
        <p class="lead">Enter your new password below.</p>
      </div>

      <div class="mb-3">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            {{ $errors->first() }}
          </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
          @csrf

          <input type="text" name="token" value="{{ request()->route('token') }}">
          <input type="text" name="email" value="{{ request()->input('email') }}">

          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter new password" required autofocus />
          </div>

          <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirm new password" required />
          </div>

          <div class="d-grid gap-2 mt-3">
            <button class="btn btn-lg btn-primary" type="submit">Reset Password</button>
          </div>
        </form>
      </div>

      <div class="text-center mt-3">
        <a href="{{ route('login') }}">Back to Login</a>
      </div>
    </div>
  </div>

  <script src="{{ asset('admin') }}/assets/js/app.js"></script>
</body>
</html>
