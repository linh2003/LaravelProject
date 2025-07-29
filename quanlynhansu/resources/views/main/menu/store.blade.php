@include(
	'main.components.breadcrumb',
	[
		'breadcrumb_before' => 'Quản lý liên kết'
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<form action="{{route('menu.store')}}" method="POST">
				@csrf
				<div class="row">
					@include('main.menu.component.popup')
				</div>
				<div class="row">
					<div class="col-sm-4">
						@include('main.menu.component.catalogue')
					</div>
					<div class="col-sm-8">
						@include('main.menu.component.list')
					</div>
				</div>
			</form>
			<div class="modal fade" id="menuPosition" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<form class="form-ibox form-position-menu">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">{{__('menu.modal.left.popup.title')}}</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-message fade show"></div>
								<div class="form-group">
									<label class="col-form-label">{{__('menu.modal.left.popup.name')}}</label>
									<input type="text" name="name" class="form-control" />
									<div class="text-danger name text-italic error-input"></div>
								</div>
								<div class="form-group">
									<label class="col-form-label">{{__('menu.modal.left.popup.keyword')}}</label>
									<input type="text" name="keyword" class="form-control" />
									<div class="text-danger keyword text-italic error-input"></div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">{{__('general.button.close')}}</button>
								<button type="submit" class="btn btn-primary waves-effect ">{{__('general.button.save')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>