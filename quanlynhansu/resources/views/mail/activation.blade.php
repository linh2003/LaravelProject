<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Activation Account</title>
	<style>
		.card{border-radius:5px;-webkit-box-shadow:0 0 5px 0 rgba(43,43,43,.1),0 11px 6px -7px rgba(43,43,43,.1);box-shadow:0 0 5px 0 rgba(43,43,43,.1),0 11px 6px -7px rgba(43,43,43,.1);border:none;margin-bottom:30px;-webkit-transition:all .3s ease-in-out;transition:all .3s ease-in-out}
		.card .card-block {
		    padding: 1.25rem;
		}
		.text-center { text-align:center; }
		.box-password {
			color: #273ccd;
		    font-size: 16px;
		    display: inline-block;
		    background: #cfe9fe;
		    border-radius: 15px;
		    font-weight: normal;
		    font-style: normal;
		    line-height: 19.2px;
		    width: auto;
		    text-align: center;
		    padding: 20px 75px 15px;
		}
		.btn-login {
			color: #fff;
		    font-size: 16px;
		    display: inline-block;
		    background: #2f5acf;
		    border-radius: 40px;
		    font-weight: normal;
		    font-style: normal;
		    line-height: 19.2px;
		    width: auto;
		    text-align: center;
		    padding: 20px 50px 15px;
		}
	</style>
</head>
<body>
	<div class="card">
		<div class="card-block">
			<div class="text-center">
				<p>Password</p>
				<a class="box-password" href="javascript:void(0)">{{$data['password']}}</a>
				<p>Email: {{$data['email']}}</p>
				<a href="{{$data['url']}}" class="btn-login">Login</a>
			</div>
		</div>
	</div>
</body>
</html>