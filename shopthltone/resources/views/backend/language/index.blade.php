
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('language.create') }}"><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.language.component.filter')
					<div class="table-responsive">
						<div class="clear">
							<div class="row">
								<div class="col-sm-6">
									@if(count($data)>0) <p>Showing {{$data->firstItem()}} to {{$data->lastItem()}} / {{$counter}}</p> @endif
								</div>
							</div>
						</div>
						@include('backend.language.component.table')
						{{ $data->links('pagination::bootstrap-4') }}
					</div>
					
				</div>
            </div>
        </div>
    </div>
</div>