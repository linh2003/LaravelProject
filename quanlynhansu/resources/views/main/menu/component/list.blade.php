<div class="card">
	<div class="card-block link-list">
		<div class="menu-wrapper">
			<div class="dd" id="nestable">
			@if(empty($nestableHtml))
				<ol class="dd-list"></ol>
			@else
			{!! $nestableHtml !!}
			@endif
			</div>
			<textarea name="menu_nestable" id="nestable-output" class="form-control hide"></textarea>
			<div class="external-menu-item">
			@if(isset($nestable))
				@foreach($nestable as $k => $item)
					<div class="modal fade" id="menu-item-{{$item->id}}" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
							<div class="form-ibox form-change-menu-name">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Change information menu item</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label class="col-form-label">Menu name item</label>
											<input type="text" class="form-control menu-name-item" name="menu[{{$item->id}}][name]" data-handle="dd-name-{{$item->id}}" placeholder="Enter menu name ..." value="{{$item->name ?? ''}}" />
										</div>
										<div class="form-group">
											<label class="col-form-label">Menu route item</label>
											<input type="text" class="form-control menu-route-item" name="menu[{{$item->id}}][route]" data-handle="dd-name-{{$item->id}}" placeholder="Enter menu route ..." value="{{$item->canonical ?? ''}}" />
										</div>
										<div class="form-group">
											<label class="col-form-label">Menu icon item</label>
											<input type="text" class="form-control menu-icon-item" name="menu[{{$item->id}}][icon]" data-handle="dd-name-{{$item->id}}" placeholder="Enter menu icon ..." value="{{$item->icon ?? ''}}" />
										</div>
										<div class="form-group">
											<label class="col-form-label">Role Permission</label>
											@foreach($roles as $role)
											<div class="checkbox-zoom zoom-primary d-block">
												<label>
													<input type="checkbox" class="choose-menu" name="menu[{{$item->id}}][role][]" @if(in_array($role->id,$menuRole[$item->id])) checked @endif value="{{$role->id}}"><span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
													<span>{{$role->name}}</span>
												</label>
											</div>
											@endforeach
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary action-change-menu-name" data-dismiss="modal">Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				<div class="modal fade" id="remove-menu-item" tabindex="-1" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body confirm-remove text-center">
								<h2>Are you sure?</h2>
								<div class="button-container">
									<button type="button" class="btn btn-outline btn-cancel" data-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-primary btn-remove" data-dismiss="modal">Yes, delete it!</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
			</div>
			<div class="notification text-center @if(!empty($nestableHtml)) hide @endif">
			{!! __('menu.list.notification') !!}
			</div>
		</div>
	</div>
</div>
<script>
var roles = @json($roles);
</script>