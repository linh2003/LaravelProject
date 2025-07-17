<div class="col-sm-4">
	<div class="card">
		<div class="card-header">
			<h5>{{__('menu.modal.left.title')}}</h5>
		</div>
		<div class="card-block">
		@php 
			$content = __('menu.modal.left.content')
		@endphp
		@foreach($content as $k => $it)
			<p @if($k == (count($content) - 1)) {{'class="mb-0"'}} @endif>{{$it}}</p>
		@endforeach
		</div>
	</div>
</div>
<div class="col-sm-8">
	<div class="card">
		<div class="card-header">
			<h5 class="float-left">{{__('menu.modal.right.title')}}<span class="text-danger d-inline-block">&nbsp;*</span></h5>
			<button type="button" data-target="#menuPosition" data-toggle="modal" class="btn btn-danger float-right addNewPositionMenu">{{__('menu.modal.right.btnAddNewPosition')}}</button>
			<div class="modal fade" id="menuPosition" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<form action="" method="" class="form-ibox form-position-menu">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">{{__('menu.modal.right.popup.title')}}</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-message fade show"></div>
								<div class="form-group">
									<label class="col-form-label">{{__('menu.modal.right.popup.name')}}</label>
									<input type="text" name="name" class="form-control" />
									<div class="text-danger name text-italic error-input"></div>
								</div>
								<div class="form-group">
									<label class="col-form-label">{{__('menu.modal.right.popup.keyword')}}</label>
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
		<div class="card-block">
			<select class="setupSelect2">
				<option value="0">-- {{__('menu.modal.right.optionDefault')}} --</option>
				@foreach($menuCat as $m)
				<option value="{{$m->id}}">{{$m->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>