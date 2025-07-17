<table class="table table-bordered dataTableData">
	<thead>
		<tr>
			{!! renderTableHeadingHtml(__('role.view.column')) !!}
		 </tr>
	</thead>
	<tbody>
		@foreach($roles as $k => $role)
		<tr>
			<td class="text-center align-middle">
				<div class="checkbox-zoom zoom-primary">
					<label>
						<input type="checkbox" class="checkBoxItem" name="input[]" value="{{$role->id}}">
						<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
					</label>
				</div>
			</td>
			<td class="text-center align-middle">{{ ($k + 1) }}</td>
			<td class="text-center align-middle">{{$role->name}}</td>
			<td class="text-center align-middle">{{$role->users->count()}}</td>
			<td class="text-center align-middle">
				<div class="dropdown-primary dropdown dropdown-action">
					<a href="javascript:void(0)" class="dropdown-toggle btn btn-info" data-toggle="dropdown">{{__('general.button.edit')}}</a>
					<ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
						<li>
							<a href="{{route('role.edit', $role->id)}}">{{__('general.button.edit')}}</a>
						</li>
						<li>
							<a href="{{route('role.delete', $role->id)}}">{{__('general.button.delete')}}</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>