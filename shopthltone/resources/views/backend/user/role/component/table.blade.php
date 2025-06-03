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
		
			<td width="15px"><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
			<td class="text-center">{{ ($k + $data->firstItem()) }}</td>
			<td>
				<strong>{{ $it->name }}</strong>
			</td>
			<td class="text-center">1</td>
			<td class="text-center">
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">{{$heading['index']['button']['edit']}} <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('role.edit',['id'=>$it->id]) }}">{{$heading['index']['button']['edit']}}</a></li>
						<li><a href="{{ route('role.delete',$it->id) }}">{{$heading['index']['button']['delete']}}</a></li>
					</ul>
				</div>
			</td>
		</tr>
		@endforeach
	@endif
	</tbody>
</table>