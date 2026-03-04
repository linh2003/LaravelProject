@include(
	'main.components.breadcrumb',
	[
		'breadcrumb_before' => __('license.breadcrumb'),
		'breadcrumb_after'  => __('license.index.title')
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="card">
			    <div class="card-header">
			        <h4 class="float-left mt-2">{{__('license.index.title')}}</h4>
					<div class="float-right d-flex">
						
						<a href="{{route('license.create')}}" class="btn btn-primary float-right license-store" >
							<i class="feather icon-plus"></i>{{__('general.button.create')}}
						</a>
					</div>
				</div>
				<div class="card-block table-border-style">
			        <div class="table-responsive">
						@include('main.license.component.table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>