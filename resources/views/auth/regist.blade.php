<!DOCTYPE html>

<html lang="en" data-bs-theme="dark" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left" data-sidebar-behavior="sticky">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Login</title>

	<link rel="canonical" href="auth-sign-in-2.html" />
	<link rel="shortcut icon" href="img/favicon.ico">

	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

	<link href="{{ asset('admin') }}/assets/css/app.css" rel="stylesheet">

	<script src="{{ asset('admin') }}/assets/js/settings.js"></script>
	<!-- END SETTINGS -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Q3ZYEKLQ68"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Q3ZYEKLQ68');
</script></head>

<body>

    <div class="auth-full-page d-flex">
		<div class="auth-form p-3">

			<div class="text-center">
				<h1 class="h2">Get started</h1>
				<p class="lead">
					Start creating the best possible user experience for you customers.
				</p>
			</div>

			<div class="mb-3">
				<div class="row">
					<div class="col">
				</div>
                @if ($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

				<form action="" method="POST">
                    @csrf
					<div class="mb-3">
						<label class="form-label">Full name</label>
						<input class="form-control form-control-lg" id="name" type="text" name="name" placeholder="Enter your name" />
					</div>
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input class="form-control form-control-lg" id="email" type="email" name="email" placeholder="Enter your email" />
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input class="form-control form-control-lg" id="password" type="password" name="password" placeholder="Enter password" />
						<small class="form-text text-muted">Note : Jika Mahasiswa Password harus berupa NPM.</small>
					</div>
					<div class="d-grid gap-2 mt-3">
						<button class='btn btn-lg btn-primary' type="submit">Sign up</button>
					</div>
				</form>
			</div>

			<div class="text-center">
				Already have an account? <a href='/login'>Log In</a>
			</div>
		</div>
	</div>

    
	<script src="{{ asset('admin') }}/assets/js/app.js"></script>

</body>


<!-- Mirrored from appstack.bootlab.io/auth-sign-in by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jul 2024 15:54:33 GMT -->
</html>