<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/login.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/forms.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/buttons.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/dashicons.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/l10n.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('backend/auth/css/custom.css')}}">
</head>
<body class="login js login-action-login wp-core-ui  locale-en-us">
	<div id="login">
		<h1><img src="{{asset('backend/images/logo.png')}}" alt="" /></h1>
		<form name="loginform" id="loginform" action="{{ route('admin.auth')}}" method="POST">
			@csrf
			<p>
				<label for="user_login">Username or Email Address</label>
				<input type="text" name="log" id="user_login" class="input @error('log') is-invalid @enderror" size="20" autocapitalize="off" value="{{old('log')}}">
				@error('log')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</p>

			<div class="user-pass-wrap">
				<label for="user_pass">Password</label>
				<div class="wp-pwd">
					<input type="password" name="pwd" class="i-checks" id="user_pass" class="input password-input @error('pwd') is-invalid @enderror" value="{{old('password')}}" size="20">
					@error('pwd')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Show password">
						<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
					</button>
				</div>
			</div>
			<p class="forgetmenot"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <label for="rememberme">Remember Me</label></p>
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
				<input type="hidden" name="redirect_to" value="http://localhost:8080/wpshopping/wp-admin/">
				<input type="hidden" name="testcookie" value="1">
			</p>
		</form>
	</div>
	<script type="text/javascript" src="{{asset('backend/auth/js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/auth/js/jquery-migrate.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/auth/js/hooks.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/auth/js/i18n.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/auth/js/user-profile.min.js')}}"></script>
</body>
</html>