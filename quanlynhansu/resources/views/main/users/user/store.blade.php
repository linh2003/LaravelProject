@php 
	$title = (isset($method) && $method=='create') ? __('user.create.title') : __('user.update.title');
	$action = (isset($method) && $method=='create') ? route('user.store') : route('user.update', $user->id);  
@endphp
@include(
	'main.components.breadcrumb',
	[
		'url' => 'user.view',
		'breadcrumb_before' => __('user.index.title'),
		'breadcrumb_after'  => $title
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<form action="{{$action}}" method="post" class="user-create-form">
				@csrf
				<div class="row">
					<div class="col-sm-3">
						@include('main.users.user.component.profile-left')
					</div>
					<div class="col-sm-9">
						@include('main.users.user.component.profile-right')
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
var social = @json(__('user.create.field.social.option'));
</script>