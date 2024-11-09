<form action="{{ route('admin.user') }}" method="get">
	<div class="d-flex justify-content-end">
		<div class="search-info">
			<input type="text" name="admin_user_keyword" placeholder="Search..." class=" form-control" value="{{ request('admin_user_keyword') ?? old('admin_user_keyword') }}"> 
		</div>
		<div class="roles ml-3">
		@php
			$roleRequest = request('role') ?? old('role')
		@endphp
			<select name="role" class="form-control setupSelect2 roles-option">
				<option value="">Select role</option>
				@foreach($roles as $k => $role)
					<option value="{{$role->id}}" {{$roleRequest==$role->id?'selected':''}}>{{$role->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="status ml-3 {{request('publish')}} middle {{old('publish')}}">
		@php
			$publish = request('publish') ?? old('publish');
			$arrPublish = [1=>'Publish',2=>'Unpulish'];
		@endphp
			<select name="publish" class="form-control {{$publish}}">
				<option value="0">Select status</option>
				@foreach($arrPublish as $key => $val)
					<option value="{{$key}}" {{$publish==$key?'selected':''}}>{{$val}}</option>
				@endforeach
			</select>
		</div>
		<div class="perpage ml-3">
		@php
			$perpage = request('perpage') ?? old('perpage')
		@endphp
			<select class="form-control" name="perpage">
				@for($i=20;$i<200;$i+=20)
				<option value="{{$i}}" {{($perpage==$i)?'selected':''}}>{{$i}}</option>
				@endfor
				<option value="all">All</option>
			</select>
		</div>
		<div class="action ml-3">
			<button type="submit" name="search" class="btn btn-primary"> Apply </button> 
		</div>
	</div>
	
</form>