<div class="table-responsive">
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(count($atTypes)>0) <p>Showing {{$atTypes->firstItem()}} to {{$atTypes->lastItem()}} /{{$counter}} </p> @endif
			</div>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="34px"><input type="checkbox" class="input-checkbox" name="checkAll" id="checkAll" value=""></th>
				<th width="50px">No.</th>
				<th>Tên nhóm thuộc tính</th>
				<th class="text-center" width="100px">Status</th>
				<th class="text-center" width="100px">Action</th>
			</tr>
		</thead>
		<tbody>
		@if (isset($atTypes))
			@foreach ($atTypes as $k => $it)
			<tr>
				<td width="34px"><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
				<td width="50px">{{ ($k + $atTypes->firstItem()) }}</td>
				<td>
					<strong>{{ $it->name }}</strong>
				</td>
				<td class="text-center switch-status-{{$it->id}}">
				@if($it->publish == 1)
					<input type="checkbox" class="js-switch status" atTypes-field="publish" atTypes-model="Post" atTypes-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
				@else
					<input type="checkbox" class="js-switch status" atTypes-field="publish" atTypes-model="Post" atTypes-modelId="{{$it->id}}" value="{{$it->publish}}" />
				@endif
				</td>
				<td class="text-center" width="100px">
					<a href="{{ route('product.attype.edit',['id'=>$it->id]) }}" class="btn btn-outline btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	{{ $atTypes->links('pagination::bootstrap-4') }}
</div>