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
                                    <input type="text" placeholder="Name" class="form-control" name="name" value="{{ old('name',($user->name) ?? '') }}" />
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
                                    <select name="role[]" class="form-control setupSelect2 roles-option" multiple="multiple">
										<option value="0">-- Select role --</option>
										@foreach($roles as $k => $r)
										<option value="{{$r->id}}" {{old('role',(collect($user->roles)->contains('id',$r->id)))?'selected':''}}>{{$r->name}}</option>
										@endforeach
									</select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
									<label class="control-label">Avatar</label>
                                    <input type="text" class="form-control upload-image" name="image" value="{{ old('phone',($user->image) ?? '') }}" />
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