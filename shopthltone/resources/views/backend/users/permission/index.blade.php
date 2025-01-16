@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['title'],'breadcrumb_after'=>$heading['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading['tableHeading'] }}</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('user.permission.create') }}"><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.users.permission.components.filter')
					<div class="table-responsive">
						@include('backend.users.permission.components.table')
					</div>
				</div>
            </div>
        </div>
    </div>
</div>