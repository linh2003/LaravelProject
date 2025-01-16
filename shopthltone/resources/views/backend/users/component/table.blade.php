<table class="table table-striped">
	<thead>
		<tr>
			<th><input type="checkbox" class="input-checkbox" name="checkAll" id="checkAll" value=""></th>
			<th>No.</th>
			<th>User</th>
			<th>Description</th>
			<th width="100px" class="text-center">Role</th>
			<th class="text-center">Status</th>
			<th width="150px" class="text-center">Last login</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@if (isset($data))
		@foreach ($data as $k => $it)
		<tr>
			<td><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
			<td class="text-center">{{ ($k + $data->firstItem()) }}</td>
			<td>
				<div class="row">
					<div class="col-md-4">
						@if (isset($it->image) && $it->image != null)
						<img src="{{ $it->image }}" />
						@endif
					</div>
					<div class="col-md-8">
						<strong>{{ $it->name }}</strong>
					</div>
				</div>
			</td>
			<td>
				<p><strong>Email:</strong>&nbsp;<span>{{ $it->email }}</span></p>
				@if (isset($it->fullname) && $it->fullname != null)
				<p><strong>FullName:</strong>&nbsp;<span>{{ $it->fullname }}</span></p>
				@endif
				<p><strong>Phone:</strong><span>{{ $it->phone }}</span></p>
				@if (isset($it->birthday) && $it->birthday != null)
				<p><strong>Birthday:</strong>&nbsp;<span>{{ $it->birthday }}</span></p>
				@endif
				@if (isset($it->address) && $it->address != null)
				<p><strong>Address:</strong>&nbsp;<span>{{ $it->address }}</span></p>
				@endif
			</td>
			<td width="100px" class="text-center">Quản trị</td>
			<td class="text-center switch-status-{{$it->id}}">
			@if($it->publish == 1)
				<input type="checkbox" class="js-switch status" data-field="publish" data-model="User" data-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
			@else
				<input type="checkbox" class="js-switch status" data-field="publish" data-model="User" data-modelId="{{$it->id}}" value="{{$it->publish}}" />
			@endif
			</td>
			<td width="150px" class="text-center"></td>
			<td>
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Edit <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('admin.user.edit',['id'=>$it->id]) }}">Edit</a></li>
						<li><a href="{{ route('admin.user.delete',$it->id) }}">Delete</a></li>
					</ul>
				</div>
			</td>
		</tr>
		@endforeach
	@endif
	</tbody>
</table>