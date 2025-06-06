<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left" data-sidebar-behavior="sticky">

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
</head>

<body>
	<div class="auth-full-page d-flex">
		<div class="auth-form p-3">

			<div class="text-center">
				<h1 class="h2">Forgot Password!</h1>
			</div>
@if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
			<div class="mb-3">
				<form action="" method="POST">
					@csrf
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
					</div>
					@error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
					<div class="d-grid gap-2 mt-3">
						<button class='btn btn-lg btn-primary' type="submit">Send</button>
					</div>
				</form>
			</div>

		</div>
	</div>

	<script src="{{ asset('admin') }}/assets/js/app.js"></script>
</body>
</html>
