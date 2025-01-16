<form action="{{ route('user.role') }}" method="get">
	<div class="d-flex justify-content-end">
		<div class="search-info">
			<input type="text" name="user_role_keyword" placeholder="Search..." class=" form-control" value="{{ request('user_role_keyword') ?? old('user_role_keyword') }}"> 
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
			<button type="submit" name="search" class="btn btn-primary"> Go! </button> 
		</div>
	</div>
	
</form>