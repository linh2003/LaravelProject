<form action="{{ route('user.role') }}" method="get">
	<div class="d-flex justify-content-end">
		<div class="search-info">
			<input type="text" name="keyword" placeholder="{{$heading['filter']['button']['search']}}..." class=" form-control" value="{{ request('keyword') ?? old('keyword') }}"> 
		</div>
		<div class="action ml-3">
			<button type="submit" name="search" class="btn btn-primary"> {{$heading['filter']['button']['search']}} </button> 
		</div>
	</div>
	
</form>