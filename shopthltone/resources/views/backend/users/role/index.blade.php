@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['title'],'breadcrumb_after'=>$heading['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading['tableHeading'] }}</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('user.role.create') }}"><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.users.role.filter')
					<div class="table-responsive">
						
						<table class="table table-striped">
							<thead>
								<tr>
									<th width="15px"><input type="checkbox" class="input-checkbox" name="checkAll" id="checkAll" value=""></th>
									<th class="text-center">No.</th>
									<th>Role</th>
									<th class="text-center">Sum User</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
							@if (isset($data))
								@foreach ($data as $k => $it)
								<tr>
								
									<td width="15px"><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
									<td class="text-center">{{ ($k + $data->firstItem()) }}</td>
									<td>
										<strong>{{ $it->name }}</strong>
									</td>
									<td class="text-center">{{$counter[$it->id]}}</td>
									<td class="text-center">
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Edit <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><a href="{{ route('user.role.edit',['id'=>$it->id]) }}">Edit</a></li>
												<li><a href="{{ route('user.role.delete',$it->id) }}">Delete</a></li>
											</ul>
										</div>
									</td>
								</tr>
								@endforeach
							@endif
							</tbody>
						</table>
						
					</div>
				</div>
            </div>
        </div>
    </div>
</div>