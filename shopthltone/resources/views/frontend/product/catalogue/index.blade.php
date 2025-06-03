<div class="product-catalogue page-wrapper">
    @include('frontend.component.breadcrumb')
	<div class="uk-container uk-container-center mt20">
		<div class="panel-body">
			@include('frontend.product.catalogue.filter')
			<div class="product-list mb30">
				<div class="uk-grid uk-grid-medium">
					@foreach($products as $item)
						<div class="uk-width-1-2 uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-4 mb20">
							@include('frontend.component.product_item', ['item'  => $item])
						</div>
					@endforeach
				</div>
			</div>
			<div class="paginator uk-text-center">
				@include('frontend.component.pagination', ['model' => $products])
			</div>
		</div>
    </div>
</div>