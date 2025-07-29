<!DOCTYPE html>
<html>
<head>
	@include('main.components.head')
</head>
<body cz-shortcut-listen="true" themebg-pattern="theme1">
	<div class="loader-bg" style="display: none;">
		<div class="loader-bar"></div>
	</div>
	<div id="pcoded" class="pcoded" theme-layout="horizontal" pcoded-device-type="desktop">
		<div class="pcoded-overlay-box"></div>
		@include('main.components.header')
		<div class="pcoded-main-container">
			<div class="pcoded-wrapper">
				@include('main.components.nav')
				<div class="pcoded-content">
					@include($template)
				</div>
			</div>
		</div>
	</div>
	@include('main.components.scripts')
</body>
</html>