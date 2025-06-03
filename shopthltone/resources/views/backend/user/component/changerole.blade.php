<div id="changerole-form" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="m-t-none m-b">{{$heading['index']['changerole']}}</h3>
				@include('backend.component.message')
				
				<form method="post" action="{{route('user.changerole')}}">
					@csrf
					@foreach($roles as $k => $role)
					<div class="i-checks"><label> <input type="checkbox" value="{{$role->id}}" name="user_role[]"> <i></i> {{$role->name}} </label></div>
					@endforeach
					<input type="hidden" name="user_ids" value="" />
					<div class="action ml-3 text-right">
						<button type="submit" name="save" class="btn btn-primary"> {{$general['button']['save']}} </button> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>