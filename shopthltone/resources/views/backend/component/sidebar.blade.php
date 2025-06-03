@php
$seg2 = request()->segment(2);
$seg3 = request()->segment(3);
@endphp
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span><img alt="image" class="img-circle" src="backend/img/profile_small.jpg" /></span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                         </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
			@foreach(__('sidebar.module') as $k => $m)
				<li class="{{($m['name']==$seg2)?'active':''}}">
					<a href="#">
						<i class="fa fa-{{$m['icon']}}"></i> 
						<span class="nav-label">{{$m['title']}}</span>
						@if(isset($m['sub']))<span class="fa arrow"></span>@endif
					</a>
					@if(isset($m['sub']))
					<ul class="nav nav-second-level collapse {{$seg3}}">
					@foreach($m['sub'] as $key => $sub)
						<li class="{{($sub['name']==$seg3)?'active':''}}"><a href="{{route($sub['route'])}}">{{$sub['title']}}</a></li>
					@endforeach
					</ul>
					@endif
				</li>
			@endforeach
        </ul>
    </div>
</nav>