<div class="table-responsive">
	<div class="clear">
		<div class="row">
			<div class="col-sm-6">
				@if(count($attributeTypes)>0) <p>{{$heading['index']['counter']}} {{$attributeTypes->firstItem()}} - {{$attributeTypes->lastItem()}} /{{$counter}} </p> @endif
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
		@if (isset($attributeTypes))
			@foreach ($attributeTypes as $k => $it)
			<tr>
				<td><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
				<td class="text-center">{{ ($k + $attributeTypes->firstItem()) }}</td>
				<td>
					<strong>{{ $it->name }}</strong>
				</td>
				<td class="text-center switch-status-{{$it->id}}">
				@if($it->publish == 1)
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="AttributeType" data-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
				@else
					<input type="checkbox" class="js-switch status" data-field="publish" data-model="AttributeType" data-modelId="{{$it->id}}" value="{{$it->publish}}" />
				@endif
				</td>
				<td class="text-center" width="100px">
					<a href="{{ route('product.attributetype.edit',['id'=>$it->id]) }}" class="btn btn-outline btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	{{ $attributeTypes->links('pagination::bootstrap-4') }}
</div>