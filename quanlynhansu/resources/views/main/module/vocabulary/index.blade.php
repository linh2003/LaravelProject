@include(
	'main.components.breadcrumb',
	[
		'breadcrumb_before' => __('vocabulary.view.title'),
		'breadcrumb_after'  => __('vocabulary.view.tableHeading')
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="card">
			    <div class="card-header">
			        <h4 class="float-left mt-2">Vocabulary manage</h4>
					<div class="float-right d-flex">
						<a href="{{route('vocabulary.create')}}" class="btn btn-primary float-right">
							<i class="feather icon-plus"></i>{{__('general.button.create')}}
						</a>
					</div>
				</div>
				<div class="card-block table-border-style">
					<div class="table-responsive">
					@if(isset($vocabularies))
						@include('main.module.vocabulary.component.table')
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>