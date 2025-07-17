<form action="{{route('permission.role')}}" method="POST">
@csrf
	@php $colspan = count($roles) + 1; @endphp
	<table class="table table-de table-permission">
		<thead>
			<tr>
				<td class="pl-2"><h5>PERMISSION</h5></td>
				@foreach($roles as $role)
				<td class="text-center align-middle">{{$role->name}}</td>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($permissions as $module)
			<tr>
				<td colspan="{{$colspan}}" class="pl-2"><h5>{{$module->name}}</h5></td>
			</tr>
			@foreach($module->permissions as $permission)
			<tr>
				<td class="align-middle">
					<p>{{$permission->name}}</p>
					<small>{{$permission->description}}</small>
				</td>
				@foreach($roles as $role)
				<td class="text-center align-middle">
					<div class="checkbox-zoom zoom-primary">
						<label>
							<input 
								type="checkbox" 
								class="checkBoxItem" 
								name="permission[{{$role->id}}][]" 
								value="{{$permission->id}}" 
								@if(($role->id == $config['quantrirole']) || (collect($role->permissions)->contains('id', $permission->id))) 
									checked 
								@endif
							>
							<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
						</label>
					</div>
				</td>
				@endforeach
			</tr>
			@endforeach
			@endforeach
		</tbody>
	</table>
	<div class="text-right">
		<button type="submit" class="btn btn-primary">{{__('general.button.save')}}</button>
	</div>
</form>