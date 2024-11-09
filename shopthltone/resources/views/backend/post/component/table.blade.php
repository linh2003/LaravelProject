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
				<th>Title</th>
				<th>Author</th>
				<th>Catalogues</th>
				<th>Status</th>
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
					<a href="{{route('admin.post.edit',['id'=>$it->id])}}"><strong>{{ $it->name }}</strong></a>
				</td>
				<td>Admin</td>
				<td>
					@foreach($it->post_catalogues as $val)
						@foreach($val->post_catalogue_languages as $cat)
						<a href="{{route('admin.post',['post_catalogue_id'=>$val->id])}}">{{$cat->name}}</a>&nbsp;
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
					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Edit <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="{{ route('admin.post.edit',['id'=>$it->id]) }}">Edit</a></li>
							<li><a href="{{ route('admin.post.delete',$it->id) }}">Delete</a></li>
						</ul>
					</div>
				</td>
			</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	{{ $data->links('pagination::bootstrap-4') }}
</div>