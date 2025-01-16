
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
                        <a class="dropdown-toggle increase-icon" data-toggle="dropdown" href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="publish" data-value="1">Publish all</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="publish" data-value="2">Unpublish all</a>
							</li>
						</ul>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.users.component.filter')
					<div class="table-responsive">
					<form method="POST" action="{{route('admin.user.changerole')}}">
						@csrf
						<div class="clear">
							<div class="row">
								<div class="col-sm-6">
									<p>Showing {{$data->firstItem()}} to {{$data->lastItem()}} / {{$counter}}</p>
								</div>
								<div class="col-sm-6 text-right">
									<button class="btn btn-primary" type="submit" name="cur">Change User Role</button>
								</div>
							</div>
						</div>
						@include('backend.users.component.table')
						{{ $data->links('pagination::bootstrap-4') }}
					</form>
					</div>
					
				</div>
            </div>
        </div>
    </div>
</div>