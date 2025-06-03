@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['index']['title'],'breadcrumb_after'=>$heading['index']['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5></h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('admin.promotion.create') }}"><i class="fa fa-plus"></i>&nbsp;{{$general['button']['create']}}</a>
						<a class="dropdown-toggle increase-icon" data-toggle="dropdown" href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="Promotion" data-field="status" data-value="1">{{$heading['index']['button']['publish']}}</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="Promotion" data-field="status" data-value="2">{{$heading['index']['button']['unpublish']}}</a>
							</li>
						</ul>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.promotion.promotion.component.filter')
					@include('backend.promotion.promotion.component.table')
					
				</div>
            </div>
        </div>
    </div>
</div>