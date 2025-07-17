<div class="col-sm-6">
	<div class="card">
		<div class="card-header">
			<h5 class="float-left">{{__('menu.modal.left.title')}}<span class="text-danger d-inline-block">&nbsp;*</span></h5>
			<button type="button" data-target="#menuPosition" data-toggle="modal" class="btn btn-danger float-right addNewPositionMenu">{{__('menu.modal.left.btnAddNewPosition')}}</button>
		</div>
		<div class="card-block">
			@if ($errors->any())
				<div class="text-danger">
					@foreach ($errors->all() as $error)
						<p style="font-style: italic; font-size: 13px">{{ $error }}</p>
					@endforeach
				</div>
			@endif
			<select class="setupSelect2" name="menu_catalogue_id">
				@foreach($menuCat as $m)
				<option value="{{$m->id}}">{{$m->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
<div class="col-sm-6">
	<div class="card">
		<div class="card-header">
			<h5 class="float-left">{{__('menu.modal.right.title')}}</h5>
			<button type="submit" class="btn btn-primary float-right">{{__('general.button.save')}}</button>
		</div>
		<div class="card-block">
			<select class="setupSelect2 link-display" name="menu_parent">
				@php $option = __('menu.modal.right.option') @endphp
				@foreach($option as $k => $it)
				<option value="{{$k}}">{{$it}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>