@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['index']['title'],'breadcrumb_after'=>$heading['index']['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('permission.create') }}"><i class="fa fa-plus"></i>&nbsp;{{$heading['index']['button']['create']}}</a>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.user.permission.components.filter')
					<div class="table-responsive">
						@include('backend.user.permission.components.table')
					</div>
				</div>
            </div>
        </div>
    </div>
</div>