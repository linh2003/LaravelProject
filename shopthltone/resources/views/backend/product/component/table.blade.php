<div class="table-responsive">
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(count($products)>0) <p>Showing {{$products->firstItem()}} to {{$products->lastItem()}} /{{$counter}} </p> @endif
			</div>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="34px"><input type="checkbox" class="input-checkbox" name="checkAll" id="checkAll" value=""></th>
				<th width="50px">No.</th>
				<th>Tên sản phẩm</th>
				<th>Author</th>
				<th>Catalogues</th>
				<th class="text-center" width="100px">Status</th>
				<th class="text-center" width="100px">Action</th>
			</tr>
		</thead>
		<tbody>
		@if (isset($products))
			@foreach ($products as $k => $it)
			<tr>
				<td width="34px"><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
				<td width="50px">{{ ($k + $products->firstItem()) }}</td>
				<td>
					<a href="{{route('admin.product.edit',['id'=>$it->id])}}"><strong>{{ $it->name }}</strong></a>
				</td>
				<td>Admin</td>
				<td>
					@foreach($it->product_catalogues as $val)
						@foreach($val->product_catalogue_languages as $cat)
						<a href="{{route('product.catalogue.edit',['id'=>$val->id])}}" class="badge badge-primary" target="_blank">{{$cat->name}}</a>
						@endforeach
					@endforeach
				</td>
				<td class="text-center switch-status-{{$it->id}}">
				@if($it->publish == 1)
					<input type="checkbox" class="js-switch status" products-field="publish" products-model="Product" products-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
				@else
					<input type="checkbox" class="js-switch status" products-field="publish" products-model="Product" products-modelId="{{$it->id}}" value="{{$it->publish}}" />
				@endif
				</td>
				<td class="text-center" width="100px">
					<a href="{{ route('admin.product.edit',['id'=>$it->id]) }}" class="btn btn-outline btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	{{ $products->links('pagination::bootstrap-4') }}
</div>