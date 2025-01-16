@include(
	'backend.component.breadcrumb',
	[
		'breadcrumb_before' => $heading['index']['title'],
		'breadcrumb_after'  => (isset($method) && $method=='create') ? $heading['create']['title'] : $heading['update']['title']
	]
)
<div class="wrapper wrapper-content animated fadeInRight">
@php 
$action = (isset($method) && $method == 'create') ? route('admin.product.store') : route('admin.product.update',['id'=>$product->id]);
@endphp
	<form method="POST" action="{{$action}}">
	@csrf
	@include('backend.product.component.modal')
		<div class="panel-message">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
	    <div class="row">
	        <div class="col-lg-9">
	        	<div class="ibox tabs-container">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab-1"><h5>Thông tin chung</h5></a></li>
						<li class=""><a data-toggle="tab" href="#tab-2"><h5>Cấu hình SEO</h5></a></li>
						<li class=""><a data-toggle="tab" href="#tab-3"><h5>Album</h5></a></li>
						<li class=""><a data-toggle="tab" href="#tab-4"><h5>Phiên bản</h5></a></li>
					</ul>
	        		<div class="ibox-content tab-content">
	        			@include('backend.product.component.general')
						@include('backend.product.component.seo')
						@include('backend.component.album')
						@include('backend.product.component.variant')
	        		</div>
	        	</div>
				
	        </div>
	        <div class="col-lg-3">
	            @include('backend.product.component.aside')
	        </div>
	    </div>
	</form>
	@if(isset($method) && $method=='update')
	<div id="modalDelete" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-body">
					<form action="{{route('admin.product.destroy',['id'=>$product->id])}}" method="POST">
					@csrf
						<p class="text-center">Bạn có chắc chắn muốn xóa sản phẩm <br/><span class="text-danger text-bold">{{$product->name}}</span></p>
						<input type="hidden" name="id" value="{{$product->id}}" />
						<div class="text-center">
							<button type="submit" class="btn btn-danger" name="aplly_delete">Apply</button>
							<button type="button" class="btn btn-white cancel_delete" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
