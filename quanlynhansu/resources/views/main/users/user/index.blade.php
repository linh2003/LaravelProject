@include(
	'main.components.breadcrumb',
	[
		'breadcrumb_before' => __('user.index.title'),
		'breadcrumb_after'  => __('user.index.tableHeading')
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="card">
			    <div class="card-header">
			        <h4 class="float-left mt-2">{{__('user.index.tableHeading')}}</h4>
					<div class="float-right d-flex">
						@if(Gate::check('modules', 'user.edit.any'))
						<a href="{{route('user.create')}}" class="btn btn-primary float-right">
							<i class="feather icon-plus"></i>{{__('general.button.create')}}
						</a>
						<div class="dropdown-primary dropdown list-view ml-1">
							<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
								<i class="feather icon-settings"></i>
							</a>
							<ul class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
								<li>
									<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="status" data-value="{{config('apps.general.publish')}}">{{__('user.index.button.publish')}}</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="status" data-value="{{config('apps.general.unpublish')}}">{{__('user.index.button.unpublish')}}</a>
								</li>
								<li>
									<a href="javascript:void(0)" class="change-role-user" data-target="#changeRole" data-toggle="modal">{{__('user.index.button.changerole')}}</a>
								</li>
							</ul>
						</div>
						@endif
					</div>
			    </div>
			    <div class="card-block table-border-style">
			        <div class="table-responsive">
			            @include('main.users.user.component.table')
			        </div>
			    </div>
			</div>
			<div class="modal fade" id="changeRole">
				<div class="modal-dialog" role="document">
					<form action="{{route('user.changerole')}}" method="POST">
						@csrf
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">{{__('user.index.changerole.title')}}</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<input type="hidden" name="user_ids" value="" />
								@foreach($roles as $role)
								<div class="checkbox-zoom zoom-primary">
									<label>
										<input type="checkbox" name="user_role[]" value="{{$role->id}}">
										<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
										<span>{{$role->name}}</span>
									</label>
								</div>
								@endforeach
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary waves-effect">{{__('general.button.save')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>