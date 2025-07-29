<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{__('auth.403.title')}}</title>
	<link rel="stylesheet" type="text/css" href="{{asset('backend/css/bootstrap.min.css')}}">
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
					<div class="text-center">
						<img src="{{asset('backend/images/logo.png')}}" alt="logo.png">
					</div>
					<div class="auth-box card">
						<div class="card-block">
							<div class="row m-b-20">
								<div class="col-md-12">
									<h3 class="text-center"><i class="icofont icofont-lock text-primary f-80"></i></h3>
								</div>
							</div>
							<div class="row m-b-20">
								<div class="col-md-12">
									<h4 class="text-center txt-primary">{{__('auth.403.content')}}</h4>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-12">
									<a href="{{url()->previous()}}" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20"><i class="icofont icofont-ui-previous"></i>{{__('auth.403.back')}}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>