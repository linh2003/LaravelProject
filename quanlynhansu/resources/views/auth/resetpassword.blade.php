<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{__('auth.resetpass.title')}}</title>
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/dashicons.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/pages.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/libraries/icofont.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/custom.css')}}">
</head>
<body themebg-pattern="theme1" cz-shortcut-listen="true" class="login">
	<section class="login-block">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<form action="{{route('password.update')}}" method="POST" class="md-float-material form-material">
						@csrf
						<div class="text-center">
							<img src="{{asset('backend/images/logo.png')}}" alt="logo.png">
						</div>
						<input type="hidden" name="token" value="{{$token}}" />
						<div class="auth-box card">
							<div class="card-block">
								<div class="row m-b-20">
									<div class="col-md-12">
										<h3 class="text-left">{{__('auth.resetpass.title')}}</h3>
									</div>
								</div>
								<div class="form-group form-primary">
									<input type="text" name="email" class="form-control @error('email') is-invalid fill @enderror" value="{{old('email', $email ?? null)}}" />
									<span class="form-bar"></span>
									<label class="float-label">Your Email Address</label>
									@error('email')
										<div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="user-pass-wrap">
									<div class="form-group form-primary wp-pwd">
										<input type="password" name="password" id="user_pass" class="form-control input password-input @error('password') is-invalid @enderror" placeholder="Password" >
										<span class="form-bar"></span>
										<button type="button" class="button button-secondary wp-hide-pw" data-toggle="0" aria-label="Show password">
											<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
										</button>
										@error('password')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="user-pass-wrap">
									<div class="form-group form-primary wp-pwd">
										<input type="password" name="password_confirmation" id="user_pass" class="form-control input password-input @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" >
										<span class="form-bar"></span>
										<button type="button" class="button button-secondary wp-hide-pw" data-toggle="0" aria-label="Show password">
											<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
										</button>
										@error('repassword')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
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