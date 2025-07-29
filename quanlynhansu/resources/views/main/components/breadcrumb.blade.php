<div class="page-header card">
	<div class="row align-items-end">
		<div class="col-lg-6">
			<div class="page-header-title">
				<i class="feather icon-sidebar bg-c-blue"></i>
				<div class="d-inline-block mt-2">
					@if(isset($breadcrumb_before)) <h5>{{$breadcrumb_before}}</h5> @endif
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="page-header-breadcrumb">
				<ul class=" breadcrumb breadcrumb-title">
					<li class="breadcrumb-item">
						<a href="{{route('dashboard')}}"><i class="feather icon-home"></i></a>
					</li>
					@if(isset($breadcrumb_before))
					<li class="breadcrumb-item"><a href="@if(isset($url)) {{route($url)}} @endif">{{$breadcrumb_before}}</a>
					@endif
					</li>
					@if(isset($breadcrumb_after))
					<li class="breadcrumb-item">
						<span>{{$breadcrumb_after}}</span>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>