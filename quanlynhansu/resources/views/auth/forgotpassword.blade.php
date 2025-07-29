<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{__('auth.forgotpass.title')}}</title>
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/pages.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/icofont.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/custom.css')}}">
</head>
<body themebg-pattern="theme1" cz-shortcut-listen="true" class="login">
	<section class="login-block">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<form action="{{route('password.email')}}" method="POST" class="md-float-material form-material">
						@csrf
						<div class="text-center">
							<img src="{{asset('backend/images/logo.png')}}" alt="logo.png">
						</div>
						<div class="auth-box card">
							<div class="card-block">
								<div class="row m-b-20">
									<div class="col-md-12">
										<h3 class="text-left">Recover your password</h3>
									</div>
								</div>
								<div class="form-group form-primary">
									<input type="text" name="email" class="form-control @error('email') is-invalid fill @enderror" value="{{old('email')}}" />
									<span class="form-bar"></span>
									<label class="float-label">Your Email Address</label>
									@error('email')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Reset Password</a>
									</div>
								</div>
								<p class="f-w-600 text-right">Back to <a href="{{route('auth.admin')}}">Login.</a></p>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="{{asset('backend/js/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/libraries/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/libraries/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/libraries/waves.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/libraries/common-pages.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/libraries/hooks.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/libraries/i18n.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/libraries/user-profile.min.js')}}"></script>
</body>
</html>