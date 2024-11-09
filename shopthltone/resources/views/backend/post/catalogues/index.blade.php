@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['title'],'breadcrumb_after'=>$heading['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading['tableHeading'] }}</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('post.cat.create') }}"><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.post.catalogues.component.filter')
					@include('backend.post.catalogues.component.table')
					
				</div>
            </div>
        </div>
    </div>
</div>