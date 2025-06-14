<form action="{{route('permission.role')}}" method="POST">
@csrf
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				{!! renderTableHeadingHtml($heading['index']['columnHeading']) !!}
				@foreach($roles as $key => $role)
				<th class="text-center">{{$role->name}}</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
		@if (isset($data))
			@foreach ($data as $k => $it)
			<tr>
				<td><a href="{{route('permission.edit',['id'=>$it->id])}}">{{$it->name}}</a></td>
				@foreach($roles as $key => $role)
				<td class="text-center">
					<input type="checkbox" {{(collect($role->permissions)->contains('id',$it->id))?'checked':''}} class="i-checks" name="permission[{{$role->id}}][]" id="checkRole" value="{{$it->id}}">
				</td>
				@endforeach
			</tr>
			@endforeach
		@endif
		</tbody>
	</table>
	<div class="form-group text-right">
		<button class="btn btn-primary" type="submit" name="send" value="send">{{$heading['index']['button']['save']}}</button>
	</div>
</form>