<div class="ibox-title component-truncate component-preview">
	<div class="row">
		<div class="col-sm-9">
			<div class="preview-truncate meta-title" data-toggle="modal" data-target="#myModal">Nhập tiêu đề SEO</div>
			<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content animated fadeIn seo-container">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="h3 meta-title">Nhập tiêu đề SEO</div>
							<div class="canonical">https://duong-dan-cua-ban.html</div>
						</div>
						<div class="modal-body"><div class="meta-description">Nhập nội dung mô tả...</div></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="ibox-tools text-right">
				<button class="btn btn-primary" type="submit" name="send">
					<i class="fa fa-check"></i>
					<span>Save</span>
				</button>
				@if(isset($method) && $method=='update')
					<button class="btn btn-danger action-delete" id="actionDelete" type="button" name="delete" data-toggle="modal" data-target="#modalDelete">
						<i class="fa fa-times"></i>
						<span>Delete</span>
					</button>
				@endif
				<a class="btn btn-default" href="{{route('admin.product')}}"><i class="fa fa-bars" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
</div>