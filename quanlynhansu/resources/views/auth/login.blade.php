<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AdminDek</title>
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
					<form action="{{route('auth.login')}}" method="POST" class="md-float-material form-material">
						@csrf
						<div class="text-center">
							<img src="{{asset('backend/images/logo.png')}}" alt="logo.png">
						</div>
						<div class="auth-box card">
							<div class="card-block">
								<div class="row m-b-20">
									<div class="col-md-12">
										<h3 class="text-center txt-primary">{{__('auth.login.form.title')}}</h3>
									</div>
								</div>
								<!-- <div class="row m-b-20">
									<div class="col-md-6">
										<button class="btn btn-facebook m-b-20 btn-block"><i class="icofont icofont-social-facebook"></i>facebook</button>
									</div>
									<div class="col-md-6">
									   <button class="btn btn-twitter m-b-20 btn-block"><i class="icofont icofont-social-twitter"></i>twitter</button>
									</div>
								</div>
								<p class="text-muted text-center p-b-5">Sign in with your regular account</p> -->
								<div class="form-group form-primary">
									<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" />
									<span class="form-bar"></span>
									<label class="float-label">{{__('auth.login.form.email')}}</label>
									@error('email')
									    <div class="alert alert-danger">{{ $message }}</div>
									@enderror
								</div>
								<div class="user-pass-wrap">
									<div class="form-group form-primary wp-pwd">
										<input type="password" name="password" id="user_pass" class="form-control input password-input @error('password') is-invalid @enderror" />
										<span class="form-bar"></span>
										<label class="float-label">{{__('auth.login.form.pass')}}</label>
										<button type="button" class="button button-secondary wp-hide-pw" data-toggle="0" aria-label="Show password">
											<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
										</button>
										@error('password')
										    <div class="alert alert-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="row m-t-25 text-left">
									<div class="col-12">
										<div class="checkbox-fade fade-in-primary">
											<label>
												<input type="checkbox" value="">
												<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
												<span class="text-inverse">Remember me</span>
											</label>
										</div>
										<div class="forgot-phone text-right float-right">
											<a href="{{route('forgot.password')}}" class="text-right f-w-600"> {{__('auth.forgotpass.label')}}</a>
										</div>
									</div>
								</div>
								<div class="row m-t-15">
									<div class="col-md-12">
										<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">{{__('auth.login.form.title')}}</button>
									</div>
								</div>
								<!-- <p class="text-inverse text-left">Don't have an account?<a href="https://www.igihm.com/dashboard/auth-sign-up-social.html"> <b>Register here </b></a>for free!</p> -->
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