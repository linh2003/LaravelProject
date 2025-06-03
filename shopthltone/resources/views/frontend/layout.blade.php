<!DOCTYPE html>
<html>
<head>
	@include('frontend.component.head')
</head>
<body>
	@include('frontend.component.header')
	@include($template)
	@include('frontend.component.footer')
	@include('frontend.component.script')
</body>
</html>