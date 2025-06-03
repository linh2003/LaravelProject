<form action="{{ route('admin.promotion') }}" method="get">
	<div class="d-flex justify-content-end">
		<div class="search-info">
			<input type="text" name="keyword" placeholder="{{$heading['filter']['button']['search']}}..." class=" form-control" value="{{ request('keyword') ?? old('keyword') }}"> 
		</div>
		<div class="catalogue-filter ml-3">
			
		</div>
		<div class="status ml-3 {{request('publish')}} middle {{old('publish')}}">
		@php
			$publish = request('publish') ?? old('publish');
		@endphp
			<select name="publish" class="form-control {{$publish}}">
				@foreach($general['publish'] as $key => $val)
					<option value="{{$key}}" {{$publish==$key?'selected':''}}>{{$val}}</option>
				@endforeach
			</select>
			
		</div>
		<div class="perpage ml-3">
		@php
			$perpage = request('perpage') ?? old('perpage')
		@endphp
			<select class="form-control" name="perpage">
				@php $selected = $perpage @endphp
				@foreach($config['config']['paginate'] as $val)
					@php if($perpage == $val){$selected = $val;} @endphp
				<option value="{{$val}}" {{($perpage==$val)?'selected':''}}>{{$val}}</option>
				@endforeach
				<option value="all" {{($selected=='all')?'selected':''}}>{{$heading['filter']['button']['perpage']}}</option>
			</select>
		</div>
		<div class="action ml-3">
			<button type="submit" name="search" class="btn btn-primary"> {{$heading['filter']['button']['search']}} </button> 
		</div>
	</div>
	
</form>