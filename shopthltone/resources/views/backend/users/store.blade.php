@include(
	'backend.component.breadcrumb',
	[
		'breadcrumb_before' => $heading['index']['title'],
		'breadcrumb_after'  => (isset($method) && $method=='create') ? $heading['create']['title'] : $heading['update']['title']
	]
)
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel-title"> {{ (isset($method) && $method=='create') ? $heading['create']['short_desc'] : $heading['update']['short_desc'] }} </div>
			<div class="panel-description">
				<p>- {{ (isset($method) && $method=='create') ? $heading['create']['description'] : $heading['update']['description'] }} </p>
				<p>- Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc</p>
			</div>
			<div class="panel-message">
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
				@php
				$action = (isset($method) && $method=='create') ? route('admin.user.store') : route('admin.user.update',$user->id)
				@endphp
                    <form method="POST" action="{{ $action }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Họ tên&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Fullname" class="form-control" name="fullname" value="{{ old('fullname',($user->fullname) ?? '') }}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Email&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email',($user->email) ?? '') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Phone</label>
                                    <input type="text" placeholder="Phone" class="form-control" name="phone" value="{{ old('phone',($user->phone) ?? '') }}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Birthday</label>
                                    <div class="input-group">
                                        <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                                        <input type="date" class="form-control" value="{{ old('birthday',(isset($user) && $user->birthday) ? date('Y-m-d',strtotime($user->birthday)) : '') }}" name="birthday">
                                    </div>
                                </div>
                            </div>
                        </div>
						@if(isset($method) && $method == 'create')
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Password&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="password" class="form-control" name="pass" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Confirm password&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="password" class="form-control" name="confirm_pass" />
									
                                </div>
                            </div>
                        </div>
						@endif
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Role</label>
                                    <select name="role" class="form-control setupSelect2 roles-option">
										<option value="">-- Select role --</option>
										@foreach($roles as $k => $role)
											<option value="{{$role->id}}" {{((isset($user) && $user->role==$role->id) || (old('role')==$role->id))?'selected':''}}>{{$role->name}}</option>
										@endforeach
									</select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
									<label class="control-label">Avatar</label>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
										<div class="form-control" data-trigger="fileinput">
											<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
										</div>
										<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="avatar"></span>
										<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>
                                </div>
                            </div>
                        </div>
						<div class="row">
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <textarea placeholder="Address" class="form-control" name="address" rows="1">{{ old('address',($user->address) ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-white" name="cancel">Cancel</a>
                            <button class="btn btn-primary" type="submit" name="send" value="send">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>