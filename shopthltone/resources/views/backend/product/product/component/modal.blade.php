<div class="ibox-title component-truncate component-preview">
	<div class="row">
		<div class="col-sm-9">
			<div class="preview-truncate meta-title" data-toggle="modal" data-target="#myModal">{{$heading['create']['modal']['title']}}</div>
			<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content animated fadeIn seo-container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{$general['button']['close']}}</span></button>
							<div class="h3 meta-title">{{$heading['create']['modal']['title']}}</div>
							<div class="canonical">https://url.html</div>
						</div>
						<div class="modal-body"><div class="meta-description">{{$heading['create']['modal']['description']}}...</div></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">{{$general['button']['close']}}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
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
					<a class="btn btn-primary" href="{{route('admin.product.create')}}" title="{{$general['button']['create']}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
				@endif
			</div>
		</div>
	</div>
	@if(!empty($nestable))
	<div id="nestable-menu">
		<button type="button" data-action="expand-all" class="btn btn-white btn-sm">{{$heading['create']['modal']['nestable']['expand']}}</button>
		<button type="button" data-action="collapse-all" class="btn btn-white btn-sm">{{$heading['create']['modal']['nestable']['collapse']}}</button>
	</div>
	<div class="dd" id="nestable">
		{!! $nestable !!}
	</div>
	<textarea id="nestable-output" class="form-control hide"></textarea>
	@endif
</div>