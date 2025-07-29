<div class="pcoded-container navbar-wrapper">
	<nav class="navbar header-navbar pcoded-header">
		<div class="navbar-wrapper">
			<div class="navbar-logo" logo-theme="theme1">
				<a href="{{asset('/')}}">
					<img class="img-fluid" src="{{asset('backend/images/logo.png')}}" alt="Theme-Logo">
				</a>
				<a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)">
					<i class="feather icon-menu icon-bar-chart"></i>
				</a>
				<a class="mobile-options waves-effect waves-light">
					<i class="feather icon-more-horizontal"></i>
				</a>
			</div>
			<div class="navbar-container container-fluid">
				<ul class="nav-left">
					<li class="header-search">
						<div class="main-search morphsearch-search">
							<div class="input-group">
								<span class="input-group-prepend search-close">
									<i class="feather icon-x input-group-text"></i>
								</span>
								<input type="text" class="form-control" placeholder="Enter Keyword">
								<span class="input-group-append search-btn">
									<i class="feather icon-search input-group-text"></i>
								</span>
							</div>
						</div>
					</li>
				</ul>
				<ul class="nav-right">
					@foreach($languages as $key => $lang)
					<li class="header-language">
						<a href="{{route('admin.language.switch',['id'=>$lang->id])}}" class="{{$lang->active?'active':''}}"><img src="{{asset($lang->image)}}" class="icon-language"/></a>
					</li>
					@endforeach
					<li class="header-notification">
						<div class="dropdown-primary dropdown">
							<div class="dropdown-toggle" data-toggle="dropdown">
								<i class="feather icon-bell"></i>
							</div>
						</div>
					</li>
					<!-- <li class="header-notification">
						<div class="dropdown-primary dropdown">
							<div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
								<i class="feather icon-message-square"></i>
							</div>
						</div>
					</li> -->
					<li class="user-profile header-notification">
						<div class="dropdown-primary dropdown">
							<div class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{asset(isset($userGlobal->image) ? $userGlobal->image : 'backend/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">
								<span>{{$userGlobal->name}}</span>
								<i class="feather icon-chevron-down"></i>
							</div>
							<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
								<!-- <li>
									 <a href="">
										<i class="feather icon-settings"></i> Settings
									</a> 
								</li> -->
								<li>
									<a href="{{route('user.edit', $userGlobal->id)}}">
										<i class="feather icon-user"></i> {{__('system.header.dropdown.profile')}}
									</a>
								</li>
								<!-- <li>
									<a href="">
										<i class="feather icon-mail"></i> My Messages
									</a>
								</li> -->
								<li>
									<a href="{{route('auth.logout')}}">
										<i class="feather icon-log-out"></i> {{__('system.header.dropdown.logout')}}
									</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</div>