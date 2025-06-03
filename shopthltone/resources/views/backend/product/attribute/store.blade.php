@include(
	'backend.component.breadcrumb',
	[
		'breadcrumb_before' => $heading['index']['title'],
		'breadcrumb_after'  => (isset($method) && $method=='create') ? $heading['create']['title'] : $heading['update']['title']
	]
)
<div class="wrapper wrapper-content animated fadeInRight">
@php 
$action = (isset($method) && $method == 'create') ? route('product.attribute.store') : route('product.attribute.update', ['id'=>$attribute->id]);
@endphp
	<form method="POST" action="{{$action}}">
	@csrf
	@include('backend.product.attribute.component.modal')
		@include('backend.component.message')
	    <div class="row">
	        <div class="col-lg-9">
	        	<div class="ibox tabs-container">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab-1"><h5>{{$heading['create']['tab'][0]}}</h5></a></li>
						<li class=""><a data-toggle="tab" href="#tab-2"><h5>{{$heading['create']['tab'][1]}}</h5></a></li>
					</ul>
	        		<div class="ibox-content tab-content">
	        			@include('backend.product.attribute.component.general')
						@include('backend.product.attribute.component.seo')
	        		</div>
	        	</div>
				
	        </div>
	        <div class="col-lg-3">
	            @include('backend.product.attribute.component.aside')
	        </div>
	    </div>
	</form>
	@if(isset($method) && $method=='update')
	<div id="modalDelete" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-body">
					<form action="{{route('product.attribute.delete',['id'=>$attribute->id])}}" method="POST">
					@csrf
						<p class="text-center">{{$heading['delete']['title']}} <br/><span class="text-danger text-bold">{{$attribute->name}}</span></p>
						<input type="hidden" name="id" value="{{$attribute->id}}" />
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
</div>