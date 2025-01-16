@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['title'],'breadcrumb_after'=>$heading['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading['tableHeading'] }}</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('admin.post.create') }}"><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
						<a class="dropdown-toggle increase-icon" data-toggle="dropdown" href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="Post" data-field="publish" data-value="1">Publish all</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="Post" data-field="publish" data-value="2">Unpublish all</a>
							</li>
						</ul>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.post.component.filter')
					@include('backend.post.component.table')
					
				</div>
            </div>
        </div>
    </div>
</div>