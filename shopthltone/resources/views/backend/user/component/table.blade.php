<table class="table table-striped">
	<thead>
		<tr>
			{!! renderTableHeadingHtml($heading['index']['columnHeading']) !!}
		</tr>
	</thead>
	<tbody>
	@if (isset($data))
		@foreach ($data as $k => $it)
		<tr>
			<td><input type="checkbox" class="checkBoxItem" name="input[]" value="{{$it->id}}"></td>
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
				@if (isset($it->name) && $it->name != null)
				<p><strong>Name:</strong>&nbsp;<span>{{ $it->name }}</span></p>
				@endif
				<p><strong>Phone:</strong><span>&nbsp;{{ $it->phone }}</span></p>
				@if (isset($it->birthday) && $it->birthday != null)
				<p><strong>Birthday:</strong>&nbsp;<span>{{ $it->birthday }}</span></p>
				@endif
				@if (isset($it->address) && $it->address != null)
				<p><strong>Address:</strong>&nbsp;<span>{{ $it->address }}</span></p>
				@endif
			</td>
			<td width="100px" class="text-center">
				@foreach($it->roles->toArray() as $role)
				<span class="badge badge-primary">{{$role['name']}}</span>
				@endforeach
			</td>
			<td class="text-center switch-status-{{$it->id}}">
			@if($it->status == 1)
				<input type="checkbox" class="js-switch status" data-field="status" data-model="User" data-modelId="{{$it->id}}" value="{{$it->status}}" checked />
			@else
				<input type="checkbox" class="js-switch status" data-field="status" data-model="User" data-modelId="{{$it->id}}" value="{{$it->status}}" />
			@endif
			</td>
			<td width="150px" class="text-center"></td>
			<td>
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">{{$general['button']['edit']}} <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('user.edit',['id'=>$it->id]) }}">{{$general['button']['edit']}}</a></li>
						<li><a href="{{ route('user.delete',$it->id) }}">{{$general['button']['delete']}}</a></li>
					</ul>
				</div>
			</td>
		</tr>
		@endforeach
	@endif
	</tbody>
</table>
