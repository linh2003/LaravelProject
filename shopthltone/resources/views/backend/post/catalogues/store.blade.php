@include(
	'backend.component.breadcrumb',
	[
		'breadcrumb_before' => $heading['index']['title'],
		'breadcrumb_after'  => $heading['index']['title']
	]
)
<div class="wrapper wrapper-content animated fadeInRight">
@php 
$action = (isset($method) && $method == 'create') ? route('post.cat.store') : route('post.cat.update',['id'=>$postCat->id]);
@endphp
	<form method="POST" action="{{$action}}">
	@csrf
		@include('backend.post.catalogues.component.modal')
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
					</ul>
	        		<div class="ibox-content tab-content">
	        			@include('backend.post.catalogues.component.general')
						@include('backend.post.catalogues.component.seo')
						@include('backend.component.album')
	        		</div>
	        	</div>
				
	        </div>
	        <div class="col-lg-3">
	            @include('backend.post.catalogues.component.aside')
	        </div>
	    </div>
	</form>
	@if(isset($method) && $method=='update')
	<div id="modalDelete" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content animated fadeIn">
				<div class="modal-body">
					<form action="{{route('post.cat.destroy',['id'=>$postCat->id])}}" method="POST">
					@csrf
						<p>Bạn có chắc chắn muốn xóa danh mục <span class="text-danger text-bold">{{$postCat->name}}</span></p>
						<input type="hidden" name="id" value="{{$postCat->id}}" />
						<div class="text-center">
							<button type="submit" class="btn btn-danger" name="aplly_delete">Aplly</button>
							<button type="button" class="btn btn-white cancel_delete" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>