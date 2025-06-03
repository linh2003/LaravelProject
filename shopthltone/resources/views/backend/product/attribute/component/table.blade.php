<div class="table-responsive">
	<form method="POST" action="{{route('product.attribute.deleteall')}}">
	@csrf
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(count($attributes)>0) <p>{{$heading['index']['counter']}} {{$attributes->firstItem()}} - {{$attributes->lastItem()}} /{{$counter}} </p> @endif
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
		@if (isset($attributes))
			@foreach ($attributes as $k => $it)
			<tr>
				<td><input type="checkbox" class="i-checks checkBoxItemListData" name="input[]" value="{{$it->id}}"></td>
				<td class="text-center">{{ ($k + $attributes->firstItem()) }}</td>
				<td>
					<strong>{{ $it->name }}</strong>
				</td>
				<td>
					@foreach($it->attribute_types as $k => $val)
						<span class="badge badge-primary">{{$val->language()?->pivot?->name}}</span>
					@endforeach
				</td>
				<td class="text-center switch-status-{{$it->id}}">
				@if($it->publish == 1)
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="AttributeType" data-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
				@else
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="AttributeType" data-modelId="{{$it->id}}" value="{{$it->publish}}" />
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
	{{ $attributes->links('pagination::bootstrap-4') }}
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