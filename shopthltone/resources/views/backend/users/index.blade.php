@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['title'],'breadcrumb_after'=>$heading['tableHeading']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 mt20">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $heading['tableHeading'] }}</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary" href="{{ route('admin.user.create') }}"><i class="fa fa-plus"></i>&nbsp;Thêm mới</a>
                        <a class="dropdown-toggle increase-icon" data-toggle="dropdown" href="#"><i class="fa fa-cog" aria-hidden="true"></i></a>
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="publish" data-value="1">Publish all</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="changStatusAll" data-model="User" data-field="publish" data-value="2">Unpublish all</a>
							</li>
						</ul>
                    </div>
                </div>
				<div class="ibox-content">
					@include('backend.users.component.filter')
					<div class="table-responsive">
					<form method="POST" action="{{route('admin.user.changerole')}}">
						@csrf
						<div class="clear">
							<div class="row">
								<div class="col-sm-6">
									<p>Showing {{$data->firstItem()}} to {{$data->lastItem()}} / {{$counter}}</p>
								</div>
								<div class="col-sm-6 text-right">
									<button class="btn btn-primary" type="submit" name="cur">Change User Role</button>
								</div>
							</div>
						</div>
						<table class="table table-striped">
							<thead>
								<tr>
									<th><input type="checkbox" class="input-checkbox" name="checkAll" id="checkAll" value=""></th>
									<th>No.</th>
									<th>User</th>
									<th>Description</th>
									<th width="100px" class="text-center">Role</th>
									<th class="text-center">Status</th>
									<th width="150px" class="text-center">Last login</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@if (isset($data))
								@foreach ($data as $k => $it)
								<tr>
									<td><input type="checkbox" class="i-checks checkBoxItem" name="input[]" value="{{$it->id}}"></td>
									<td class="text-center">{{ ($k + $data->firstItem()) }}</td>
									<td>
										<div class="row">
											<div class="col-md-4">
												@if (isset($it->image) && $it->image != null)
												<img src="{{ $it->image }}" />
												@endif
											</div>
											<div class="col-md-8">
												<strong>{{ $it->name }}</strong>
											</div>
										</div>
									</td>
									<td>
										<p><strong>Email:</strong>&nbsp;<span>{{ $it->email }}</span></p>
										@if (isset($it->fullname) && $it->fullname != null)
										<p><strong>FullName:</strong>&nbsp;<span>{{ $it->fullname }}</span></p>
										@endif
										<p><strong>Phone:</strong><span>{{ $it->phone }}</span></p>
										@if (isset($it->birthday) && $it->birthday != null)
										<p><strong>Birthday:</strong>&nbsp;<span>{{ $it->birthday }}</span></p>
										@endif
										@if (isset($it->address) && $it->address != null)
										<p><strong>Address:</strong>&nbsp;<span>{{ $it->address }}</span></p>
										@endif
									</td>
									<td width="100px" class="text-center">{{$it->roles->name}}</td>
									<td class="text-center switch-status-{{$it->id}}">
									@if($it->publish == 1)
										<input type="checkbox" class="js-switch status" data-field="publish" data-model="User" data-modelId="{{$it->id}}" value="{{$it->publish}}" checked />
									@else
										<input type="checkbox" class="js-switch status" data-field="publish" data-model="User" data-modelId="{{$it->id}}" value="{{$it->publish}}" />
									@endif
									</td>
									<td width="150px" class="text-center"></td>
									<td>
										<div class="btn-group">
											<button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Edit <span class="caret"></span></button>
											<ul class="dropdown-menu">
												<li><a href="{{ route('admin.user.edit',['id'=>$it->id]) }}">Edit</a></li>
												<li><a href="{{ route('admin.user.delete',$it->id) }}">Delete</a></li>
											</ul>
										</div>
									</td>
								</tr>
								@endforeach
							@endif
							</tbody>
						</table>
						{{ $data->links('pagination::bootstrap-4') }}
					</form>
					</div>
					
				</div>
            </div>
        </div>
    </div>
</div>