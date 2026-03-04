<table class="table table-bordered table-hover dataTableData">
	<thead>
		<tr>
			<th class="text-center align-middle" width="30px">No.</th>
			<th>Module</th>
			<th class="align-middle">Description</th>
			<th width="75px" class="text-center">Status</th>
			<th width="50px" class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($modules as $key => $module)
		<tr>
			<th class="text-center align-middle">{{($key + 1)}}</th>
			<td class="align-middle">
				<h5 class="name">{{$module->name}}</h5>
				@if($module->code != null)<small><i>{{$module->code}}</i></small>@endif
			</td>
			<td class="align-middle"><p class="description">{{$module->description}}</p></td>
			<td class="text-center align-middle switch-status-{{$module->id}}">
			@if($module->publish == 1)
				<input type="checkbox" class="js-switch status" data-field="publish" data-model="Module" data-modelId="{{$module->id}}" value="{{$module->status}}" checked />
			@else
				<input type="checkbox" class="js-switch status" data-field="publish" data-model="Module" data-modelId="{{$module->id}}" value="{{$module->publish}}" />
			@endif
			</td>
			<td class="text-center align-middle">
				<div class="dropdown-primary dropdown dropdown-action">
					<a href="javascript:void(0)" class="dropdown-toggle btn btn-info" data-toggle="dropdown">{{__('general.button.edit')}}</a>
					<ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<li>
							<a href="{{route('module.edit', $module->id)}}" class="action-item">{{__('general.button.edit')}}</a>
						</li>
						<li>
							<a href="{{route('module.delete', $module->id)}}" class="action-item">{{__('general.button.delete')}}</a>
						</li>
						<li>
							<a href="javascript:void(0)" class="action-item module-field-manage" data-target="#moduleField" data-toggle="modal" data-model="Module" data-model-id="{{$module->id}}">Field manage</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>