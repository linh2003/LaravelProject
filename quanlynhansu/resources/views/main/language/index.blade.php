<div class="card">
    <div class="card-header">
        <h5>Danh sách ngôn ngữ</h5>
    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
		
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="30px">No.</th>
                        <th width="34px">Image</th>
                        <th>Language</th>
                        <th width="75px" class="text-center">Canonical</th>
                        <th width="34px" class="text-center">Active</th>
                        <th width="50px" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
					@foreach($languages as $key => $lang)
                    <tr>
                        <th>{{($key + 1)}}</th>
                        <td><img src="{{asset($lang->image)}}" alt=""/></td>
                        <td>{{$lang->name}}</td>
                        <td class="text-center">{{$lang->canonical}}</td>
                        <td class="text-center">
							@php
								if($lang->active){
									echo '<label class="label label-success">Active</label>';
								}else{
									echo '<label class="label label-default">Inactive</label>';
								}
							@endphp
						</td>
                        <td class="text-center">
							<div class="group-action d-inline-flex button-page">
								<a href="{{route('admin.language.edit',['id'=>$lang->id])}}" class="btn btn-primary btn-sm">
									<i class="feather icon-edit"></i>
								</a>
								<a href="{{route('admin.language.delete',['id'=>$lang->id])}}" class="btn btn-danger btn-sm">
									<i class="feather icon-trash-2"></i>
								</a>
							</div>
						</td>
                    </tr>
					@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>