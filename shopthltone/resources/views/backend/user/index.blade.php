@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['index']['title'],'breadcrumb_after'=>$heading['index']['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('user.create') }}"><i class="fa fa-plus"></i>&nbsp;{{$general['button']['create']}}</a>
                        <a class="dropdown-toggle increase-icon" data-toggle="dropdown" href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="status" data-value="{{$heading['filter']['option']['publish']['value']}}">{{$heading['index']['button']['publish']}}</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="status" data-value="{{$heading['filter']['option']['unpublish']['value']}}">{{$heading['index']['button']['unpublish']}}</a>
							</li>
						</ul>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.user.component.filter')
					<div class="table-responsive">
					<form method="POST" action="route('admin.user')">
						@csrf
						<div class="clear">
							<div class="row">
								<div class="col-sm-6">
									<p>{{$heading['index']['counter']}} {{$data->firstItem()}} - {{$data->lastItem()}} / {{$counter}}</p>
								</div>
								<div class="col-sm-6 text-right">
									
									<a data-toggle="modal" class="btn btn-primary" id="changerole" href="#changerole-form">{{$heading['index']['button']['changerole']}}</a>
								</div>
							</div>
						</div>
						@include('backend.user.component.table')
						{{ $data->links('pagination::bootstrap-4') }}
					</form>
					</div>
					@include('backend.user.component.changerole')
				</div>
            </div>
        </div>
    </div>
</div>