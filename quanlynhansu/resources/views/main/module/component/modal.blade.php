<div class="modal fade" id="moduleField">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{route('field.store')}}" method="POST" class="form-ibox form-field-module">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Field manage for <label></label></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="modelId" class="model-id" value="" />
					<div class="field-container"></div>
					<button type="button" class="btn btn-primary prn-0 mrn-0 field-add-new"><i class="icofont icofont-plus"></i></button>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary waves-effect actionQuickAdd">{{__('general.button.save')}}</button>
				</div>
			</form>
		</div>
	</div>
</div>