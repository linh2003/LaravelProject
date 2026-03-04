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
							@if(isset($notifications) && count($notifications) > 0)
							<ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
								<li>
									<h6>Notifications</h6>
									<label class="label label-danger">New</label>
								</li>
								@foreach($notifications as $notify)
								<li>
									<div class="media">
										<img class="img-radius" src="{{asset(config('apps.user.avatar.default'))}}" alt="">
										<div class="media-body">
											<h5 class="notification-user">{{$notify->title}}</h5>
											<p class="notification-msg">{{$notify->message ?? ''}}</p>
											<span class="notification-time">30 minutes ago</span>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
							@endif
						</div>
					</li>
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
<script>
	document.addEventListener('DOMContentLoaded', function () {
		var container = document.querySelector('.header-notification .dropdown-toggle');
		if (!container) return;
		var BADGE_CLASS = 'badge bg-c-red';
		var url = '{{ route("notification.unread.count") }}';
		function updateNotificationBadge() {
			fetch(url, {
				method: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				credentials: 'same-origin'
			})
			.then(function (response) {
				return response.json();
			})
			.then(function (data) {
				var count = data.count || 0;
				var badge = container.querySelector('.badge.bg-c-red');

				if (count > 0) {
					if (!badge) {
						badge = document.createElement('span');
						badge.className = BADGE_CLASS;
						container.appendChild(badge);
					}
					badge.textContent = count;
				} else {
					if (badge) {
						badge.remove();
					}
				}
			})
			.catch(function (error) {
				console.error('Notification badge error:', error);
			});
		}
		// gọi ngay khi load + lặp lại mỗi 5 giây
		updateNotificationBadge();
		setInterval(updateNotificationBadge, 5000);
	});
</script>