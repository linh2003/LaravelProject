<div class="table-responsive">
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(count($data)>0) <p>Showing {{$data->firstItem()}} to {{$data->lastItem()}} /{{$counter}} </p> @endif
			</div>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="34px"><input type="checkbox" class="input-checkbox" name="checkAll" id="checkAll" value=""></th>
				<th width="50px">No.</th>
				<th>Tên thuộc tính</th>
				<th>Nhóm thuộc tính</th>
				<th class="text-center" width="100px">Status</th>
				<th class="text-center" width="100px">Action</th>
			</tr>
		</thead>
		<tbody>
		@if (isset($data))
			@foreach ($data as $k => $it)
			<tr>
				<td width="34px"><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
				<td width="50px">{{ ($k + $data->firstItem()) }}</td>
				<td>
					<strong>{{ $it->name }}</strong>
				</td>
				<td>
					@foreach($it->attribute_types as $val)
						@foreach($val->attribute_type_languages as $atType)
						<a class="badge badge-primary" href="{{route('product.attype.edit',['id'=>$val->id])}}" target="_blank">{{$atType->name}}</a>
						@endforeach
					@endforeach
				</td>
				<td class="text-center switch-status-{{$it->id}}">
				@if($it->publish == 1)
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="Post" data-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
				@else
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="Post" data-modelId="{{$it->id}}" value="{{$it->publish}}" />
				@endif
				</td>
				<td class="text-center" width="100px">
					<a href="{{ route('product.attribute.edit',['id'=>$it->id]) }}" class="btn btn-outline btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	{{ $data->links('pagination::bootstrap-4') }}
</div>