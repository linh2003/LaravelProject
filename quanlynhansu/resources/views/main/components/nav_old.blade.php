{{dd($menus)}}
<nav class="pcoded-navbar is-hover" navbar-theme="themelight1">
	<div class="pcoded-inner-navbar">
		<ul class="pcoded-item">
		@foreach(__('nav.module') as $k => $it)
			<li class="pcoded-hasmenu is-hover" subitem-icon="style1" dropdown-icon="style1">
				<a href="javascript:void(0)" class="waves-effect waves-dark">
					<span class="pcoded-micon"><i class="feather {{$it['icon']}}"></i></span>
					<span class="pcoded-mtext">{{$it['title']}}</span>
				</a>
				@if(isset($it['sub']) && count($it['sub']) > 0)
				<ul class="pcoded-submenu">
				@foreach($it['sub'] as $key => $val)
					<li class=" is-hover">
						<a href="{{route($val['route'])}}" class="waves-effect waves-dark">
							<span class="pcoded-mtext">{{$val['title']}}</span>
						</a>
					</li>
				@endforeach
				</ul>
				@endif
			</li>
		@endforeach
		</ul>
	</div>
</nav>