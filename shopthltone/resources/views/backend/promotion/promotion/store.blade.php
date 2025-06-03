@include(
	'backend.component.breadcrumb',
	[
		'breadcrumb_before' => $heading['index']['title'],
		'breadcrumb_after'  => (isset($method) && $method=='create') ? $heading['create']['title'] : $heading['update']['title']
	]
)
<div class="wrapper wrapper-content animated fadeInRight">
	@php
		$action = (isset($method) && $method=='create') ? route('admin.promotion.store') : route('admin.promotion.update', $promotion->id);
		$methodPromotionProduct = $heading['create']['field']['type_option']['value_product']['discount'];
		$labelPromotionProduct = $heading['create']['field']['type_option']['product']['name'];
		$modalPromotionProduct = $heading['create']['field']['type_option']['product']['modal'];
		$errorPromotionValue = $heading['create']['field']['type_option']['value_product']['error'];
	@endphp
	<form method="POST" action="{{ $action }}">
		@csrf
		@include('backend.component.message')
		<div class="ibox-title component-preview">
			<div class="row">
				<div class="col-sm-12">
					<div class="ibox-tools text-right">
						<button class="btn btn-primary" type="submit" name="send">
							<i class="fa fa-check"></i>
							<span>{{$general['button']['save']}}</span>
						</button>
						@if(isset($method) && $method=='update')
							<button class="btn btn-danger action-delete" id="actionDelete" type="button" name="delete" data-toggle="modal" data-target="#modalDelete">
								<i class="fa fa-times"></i>
								<span>{{$general['button']['delete']}}</span>
							</button>
						@endif
						<a class="btn btn-default" href="{{route('admin.promotion')}}"><i class="fa fa-bars" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-8">
				@include('backend.promotion.promotion.component.general')
			</div>
			<div class="col-sm-4">
				@include('backend.promotion.promotion.component.aside')
			</div>
		</div>
	</form>
	@if(isset($method) && $method=='update')
	<div id="modalDelete" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-body">
					<form action="{{route('admin.promotion.delete',['id'=>$promotion->id])}}" method="POST">
					@csrf
						<p class="text-center">{{$heading['delete']['title']}} <br/><span class="text-danger text-bold">{{$promotion->name}}</span></p>
						<input type="hidden" name="id" value="{{$promotion->id}}" />
						<div class="text-center">
							<button type="submit" class="btn btn-danger" name="aplly_delete">{{$general['button']['apply']}}</button>
							<button type="button" class="btn btn-white cancel_delete" data-dismiss="modal">{{$general['button']['cancel']}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endif
	@include('backend.promotion.promotion.component.modal')
</div>
@php 
	$value_product = (isset($promotion) && $promotion->type == 'value_product') ? $promotion->discount : '';
	$apply_product = (isset($promotion) && $promotion->type == 'product') ? $promotion->discount['aplly_promotion_product'] : '';
	$module = (isset($promotion) && $promotion->type == 'product') ? $promotion->discount['module'] : '';
@endphp
<input type="hidden" name="preload_type_promotion" value="{{old('module', $module)}}" />
<input type="hidden" name="preload_value_product_promotion" value="{{json_encode(old('discount_promotion_value_product', $value_product))}}" /> 
<input type="hidden" name="preload_product_promotion" value="{{json_encode(old('aplly_promotion_product', $apply_product))}}" /> 
<script>
	let methodPromotionProduct = @json($methodPromotionProduct);
	let labelPromotionProduct = @json($labelPromotionProduct);
	let modalPromotionProduct = @json($modalPromotionProduct);
	let errorPromotionValue = @json($errorPromotionValue);
	let promotionValueValid = true;
</script>