<div class="table-responsive">
	<form method="POST" action="{{route('admin.product.deleteall')}}">
	@csrf
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(isset($products) && count($products)>0) <p>{{$heading['index']['counter']}} {{$products->firstItem()}} - {{$products->lastItem()}} /{{$counter}} </p> @endif
			</div>
		</div>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				{!! renderTableHeadingHtml($heading['index']['columnHeading']) !!}
			</tr>
		</thead>
		<tbody>
		@if (isset($products))
			@foreach ($products as $k => $it)
			<tr>
				<td><input type="checkbox" class="checkBoxItem checkBoxItemListData" name="input[]" value="{{$it->id}}"></td>
				<td class="text-center">{{ ($k + $products->firstItem()) }}</td>
				<td>
				@if(!empty($it->image))
					<div class="row">
						<div class="col-sm-3"><a href="{{route('admin.product.edit', $it->id)}}"><img src="{{asset($it->image)}}" width="100px" /></a></div>
						<div class="col-sm-9">
							<h4><a href="{{route('admin.product.edit', $it->id)}}"><strong>{{ $it->name }}</strong></a></h4>
							<div class="catalogues mb10">
								<small><i style="color:red">{{$heading['index']['tableBody']['catalogue']}}:&nbsp;</i></small>
								@php
									$catalogues = [];
									$i = 0;
									foreach($it->product_catalogues as $key => $p){
										$catalogues[$p->product_catalogue_language()->first()->product_catalogue_id] = $p->product_catalogue_language()->first()->name;
									}
									
								@endphp
								@foreach($catalogues as $k => $cat)
								<a href="{{route('product.catalogue.edit',$k)}}"><small>{{$cat}}</small></a>
								@if($i++ < count($catalogues) - 1) {{', '}} @endif
								@endforeach
							</div>
							<div class="product-sku mb10">
								<small><i style="color:red">{{$heading['index']['tableBody']['code']}}:&nbsp;</i></small>
								{{$it->code}}
							</div>
						</div>
					</div>
				@else
					<a href="{{route('admin.product.edit', $it->id)}}"><strong>{{ $it->name }}</strong></a>
				@endif
				</td>
				<td class="text-center">
					{{$it->quantity}}
				</td>
				<td class="text-right">
					<b>{{number_format($it->price)}}</b>
				</td>
				<td class="text-center switch-status-{{$it->id}}">
				@if($it->publish == 1)
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="Product" data-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
				@else
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="Product" data-modelId="{{$it->id}}" value="{{$it->publish}}" />
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
	@if (isset($products)) {{ $products->links('pagination::bootstrap-4') }} @endif
		<div class="action-delete-all-list-data text-right hide">
			<button class="btn btn-danger action-delete-all" id="actionDeleteAll" type="button" name="delete_all" data-toggle="modal" data-target="#modalDeleteAll">
				<i class="fa fa-times"></i>
				<span>{{$general['button']['delete_all']}}</span>
			</button>
		</div>
		<div id="modalDeleteAll" class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content animated fadeIn">
					<div class="modal-body">
						<p class="text-center">{{$heading['delete']['title']}}</p>
						<div class="text-center">
							<button type="submit" class="btn btn-danger" name="aplly_delete">{{$general['button']['apply']}}</button>
							<button type="button" class="btn btn-white cancel_delete" data-dismiss="modal">{{$general['button']['cancel']}}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>