<div class="card">
	<div class="card-block tab-icon">
		<ul class="nav nav-tabs md-tabs mb-3" role="tablist">
		@php $i = 0; @endphp
		@foreach(__('user.create.tabs') as $tabKey => $tab)
			<li class="nav-item">
				<a class="nav-link @if($i == 0) {{'active'}} @endif" data-toggle="tab" href="#{{$tabKey}}" role="tab"><i class="icofont {{$tab['icon']}}"></i>{{$tab['label']}}</a>
				<div class="slide"></div>
			</li>
			@php $i++ @endphp
		@endforeach
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="generalInfor" role="tabpanel">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.name')}}<span class="text-danger d-inline-block">&nbsp;*</span></label>
							<div class="col-sm-12">
								<input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" placeholder="Enter Name" value="{{old('name', $user->name ?? '')}}" />
								@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
							</div>
						</div>
						
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.email')}}<span class="text-danger d-inline-block">&nbsp;*</span></label>
							<div class="col-sm-12">
								<input type="text" class="form-control @error('email') form-control-danger @enderror" name="email" value="{{old('email', $user->email ?? '')}}" />
								@error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.gender.label')}}</label>
							<div class="col-sm-12">
								<div class="form-radio">
									<div class="radio radio-inline">
										<label>
											<input type="radio" name="gender" @if(isset($user) && $user->gender == config('apps.general.gender.male')) checked @endif value="{{config('apps.general.gender.male')}}">
											<i class="helper"></i>{{__('user.create.field.gender.male')}}
										</label>
									</div>
									<div class="radio radio-inline">
										<label>
											<input type="radio" name="gender" @if(isset($user) && $user->gender == config('apps.general.gender.female')) checked @endif value="{{config('apps.general.gender.female')}}">
											<i class="helper"></i>{{__('user.create.field.gender.female')}}
										</label>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Row 1 -->
				</div>
				<div class="row">
					@php $birthday = isset($user->birthday) ? formatDate($user->birthday, 'd/m/Y') : '';  @endphp
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.birthday')}}</label>
							<div class="col-sm-12">
								<div class="input-group date mb-0" id="birthday">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" class="form-control" name="birthday" value="{{old('birthday', $birthday) ?? Carbon\Carbon::today()->format('d/m/Y')}}">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.phone')}}<span class="text-danger d-inline-block">&nbsp;*</span></label>
							<div class="col-sm-12">
								<input type="text" class="form-control @error('phone') form-control-danger @enderror" name="phone" value="{{old('phone', $user->phone ?? '')}}" />
								@error('phone')<div class="alert alert-danger">{{ $message }}</div>@enderror
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.status')}}</label>
							<div class="col-sm-12">
								@if(isset($method) && $method=='create')
								<input type="checkbox" class="js-switch status" name="status" value="1" checked />
								@else
								<input type="checkbox" class="js-switch status" name="status" value="{{$user->status ?? ''}}" @if(isset($user->status) && $user->status == 1) checked @endif />
								@endif
							</div>
						</div>
					</div>
				</div> <!-- Row 2 -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.department')}}</label>
							<div class="col-sm-12">
								<select class="form-control" name="department">
									<option value="">-- {{__('general.select')}} --</option>
								</select>
							</div>
						</div>
					</div>
					@if(isset($method) && $method=='create')
					<div class="col-sm-4">
						<div class="user-pass-wrap login">
							<label class="col-form-label">{{__('user.create.field.password')}}<span class="text-danger d-inline-block">&nbsp;*</span></label>
							<div class="form-group form-primary wp-pwd">
								<input type="password" name="password" id="user_pass" class="form-control input password-input @error('password') is-invalid @enderror" placeholder="Password" >
								<span class="form-bar"></span>
								<button type="button" class="button button-secondary wp-hide-pw" data-toggle="0" aria-label="Show password">
									<span class="dashicons dashicons-visibility" aria-hidden="true"></span>
								</button>
								@error('password')
								    <div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
					@endif
				</div> <!-- Row 3 -->
			</div> <!-- End tab 1 -->
			<div class="tab-pane" id="personalInfor" role="tabpanel">
				<div class="row">
					@php 
						$day_of_join = isset($user->day_of_join) ? formatDate($user->day_of_join, 'd/m/Y') : '';  
						$day_of_leave = isset($user->day_of_leave) ? formatDate($user->day_of_leave, 'd/m/Y') : '';  
					@endphp
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.dayofjoin')}}</label>
							<div class="col-sm-12">
								<div class="input-group date mb-0" id="dayofjoin">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" class="form-control" name="day_of_join" value="{{old('day_of_join', $day_of_join) ?? Carbon\Carbon::today()->format('d/m/Y')}}">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.dayofleave')}}</label>
							<div class="col-sm-12">
								<div class="input-group date mb-0" id="dayofjoin">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" class="form-control" name="day_of_leave" value="{{old('day_of_leave', $day_of_leave) ?? Carbon\Carbon::today()->format('d/m/Y')}}">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.dayoffnumber')}}</label>
							<div class="col-sm-12">
								 <input type="text" class="form-control" name="day_off_number" value="{{old('day_off_number', $user->day_off_number ?? '')}}" />
							</div>
						</div>
					</div>
				</div> <!-- Row 1 -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.province')}}</label>
							<div class="col-sm-12">
								<select class="form-control setupSelect2 location" name="province_id" data-target="district" data-location="province">
									<option value="">-- Select --</option>
									@foreach($province as $province)
									<option value="{{$province->code}}" {{old('province_id', $user->province_id ?? '') == $province->code ? 'selected' : ''}}>{{$province->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.district')}}</label>
							<div class="col-sm-12">
								<select class="form-control setupSelect2 location" name="district_id" data-target="ward" data-location="district">
									<option value="">-- Select --</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.ward')}}</label>
							<div class="col-sm-12">
								<select class="form-control setupSelect2" name="ward_id">
									<option value="">-- Select --</option>
								</select>
							</div>
						</div>
					</div>
				</div> <!-- Row 2 -->
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.cccd')}}</label>
							<div class="col-sm-12">
								 <input type="text" class="form-control" name="cccd" value="{{old('cccd', $user->cccd ?? '')}}" />
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.bhxh')}}</label>
							<div class="col-sm-12">
								 <input type="text" class="form-control" name="bhxh" value="{{old('bhxh', $user->bhxh ?? '')}}" />
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.address')}}</label>
							<div class="col-sm-12">
								<textarea rows="2" class="form-control">{{$user->address ?? ''}}</textarea>
							</div>
						</div>
					</div>
				</div> <!-- Row 3 -->
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.social.label')}}</label>
							<div class="col-sm-12 social-list">
								@if(isset($user->social))
								@foreach($user->social as $icon => $social)
								<div class="row social-item mb-2">
									<div class="col-sm-3">
										<select name="social_option[]" class="form-control setupSelect2">
										@foreach(__('user.create.field.social.option') as $key => $item)
											<option value="{{$item['icon']}}" {{$item['icon'] == $icon ? 'selected' : ''}}>{{$item['title']}}</option>
										@endforeach
										</select>
									</div>
									<div class="col-sm-7"><input type="text" name="social_path[]" class="form-control" value="{{$social}}" /></div>
									<div class="col-sm-2"><button type="button" class="btn waves-effect waves-dark btn-danger btn-outline-danger prn-0 mrn-0 social-remove-item"><i class="feather icon-trash-2"></i></button></div>
								</div>
								@endforeach
								@endif
							</div>
							<div class="col-sm-12">
								<button type="button" class="btn btn-primary prn-0 mrn-0 social-add-new"><i class="icofont icofont-plus"></i></button>
							</div>
						</div>
					</div>
				</div> <!-- Row 4 -->
			</div> <!-- End tab 2 -->
			<div class="tab-pane" id="salary" role="tabpanel">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.salary')}}</label>
							<div class="col-sm-12">
								 <input type="text" class="form-control number" name="salary" value="{{old('salary', isset($user->salary) ? convertPrice($user->salary, true) : '')}}" />
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-form-label">{{__('user.create.field.bonus')}}</label>
							<div class="col-sm-12">
								 <input type="text" class="form-control number" name="bonus" value="{{old('bonus', isset($user->bonus) ? convertPrice($user->bonus, true) : '')}}" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="action text-center">
			<a href="{{route('user.view')}}" class="btn btn-outline-primary waves-effect waves-light">{{__('general.button.cancel')}}</a>
			<button type="submit" class="btn btn-primary waves-effect waves-light">{{__('general.button.save')}}</button>
		</div>
	</div>
</div>
<script>
var province = '{{(isset($user->province_id) ? $user->province_id : old("province_id"))}}';
var district = '{{(isset($user->district_id) ? $user->district_id : old("district_id"))}}';
var ward = '{{(isset($user->ward_id) ? $user->ward_id : old("ward_id"))}}';
</script>