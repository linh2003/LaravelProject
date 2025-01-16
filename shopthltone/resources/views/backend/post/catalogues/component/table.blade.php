<div class="table-responsive">
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(count($data)>0) <p>Showing {{$data->firstItem()}} to {{$data->lastItem()}} / {{$counter}}</p> @endif
			</div>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="34px"><input type="checkbox" class="input-checkbox" name="checkAll" id="checkAll" value=""></th>
				<th width="50px">No.</th>
				<th>Language</th>
				<th class="text-center">Canonical</th>
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
					<div class="language-wrapper">
						@if (isset($it->image) && $it->image != null)
						<div class="language-item flag">
							<div class="width-image-35"><img src="{{ $it->image }}" class="wimage" /></div>
						</div>
						@endif
						<div class="language-item language">
							<strong>{{ $it->name }}</strong>
						</div>
					</div>
				</td>
				<td class="text-center">{{$it->canonical}}</td>
				<td class="text-center" width="100px">
					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Edit <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="{{ route('post.cat.edit',['id'=>$it->id]) }}">Edit</a></li>
							<li><a href="{{ route('post.cat.delete',$it->id) }}">Delete</a></li>
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