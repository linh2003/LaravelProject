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
                        <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            
            
			@foreach(__('sidebar.module') as $k => $c)
			@php $sub = $seg2.(!empty($seg3)?('.'.$seg3):''); @endphp
			<li class="{{($c['name']==$seg2)?'active':''}}">
                <a href="{{(!isset($c['submodule']))?route($c['route']):'#'}}"><i class="fa fa-{{isset($c['icon'])?$c['icon']:''}}"></i> <span class="nav-label">{{isset($c['title'])?$c['title']:''}}</span><span class="fa {{isset($c['submodule'])?'arrow':''}}"></span></a>
				@if(isset($c['submodule']))
					<ul class="nav nav-second-level collapse {{($c['name']==$seg2)?'in':''}}">
					@foreach($c['submodule'] as $sm)
						<li class="{{$sub==$sm['name']?'active':''}}" data-name="{{$sub}}"><a href="{{route($sm['route'])}}">{{$sm['title']}}</a></li>
					@endforeach
					</ul>
				@endif
            </li>
			@endforeach
        </ul>
    </div>
</nav>