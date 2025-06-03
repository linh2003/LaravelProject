@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['index']['title'],'breadcrumb_after'=>$heading['index']['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('role.create') }}"><i class="fa fa-plus"></i>&nbsp;{{$heading['index']['button']['create']}}</a>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.user.role.component.filter')
					<div class="table-responsive">		
						<form method="POST" action="{{route('user.role')}}">
							@csrf
							<div class="clear">
								<div class="row">
									<div class="col-sm-6">
										<p>{{$heading['index']['counter']}} {{$data->firstItem()}} - {{$data->lastItem()}} / {{$counter}}</p>
									</div>
								</div>
							</div>					
							@include('backend.user.role.component.table')
							{{ $data->links('pagination::bootstrap-4') }}
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>