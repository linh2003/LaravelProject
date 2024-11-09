<form action="{{ route('admin.post') }}" method="get">
	<div class="d-flex justify-content-end">
		<div class="search-info">
			<input type="text" name="post_keyword" placeholder="Search..." class=" form-control" value="{{ request('post_keyword') ?? old('post_keyword') }}"> 
		</div>
		<div class="catalogue-filter ml-3">
			<select name="post_catalogue_id" class="fomr-control setupSelect2">
			@foreach($dropdown as $k => $d)
				<option value="{{$k}}" {{$k==old('post_catalogue_id',(request('post_catalogue_id'))?request('post_catalogue_id'):'')?'selected':''}}>{{$d}}</option>
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