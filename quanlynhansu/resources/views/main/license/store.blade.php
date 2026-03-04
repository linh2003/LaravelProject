@include(
	'main.components.breadcrumb',
	[
		'url' => 'license.view',
		'breadcrumb_before' => __('license.breadcrumb'),
		'breadcrumb_after'  => (isset($method) && $method=='create') ? __('license.create.title') : __('license.update.title')
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			@php
				$action = isset($method) && $method=='create' ? route('license.store') : route('license.update', $license->id);
				$title = (isset($method) && $method=='create') ? __('license.create.title') : __('license.update.title');
			@endphp
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-header">
							<h4 class="mb-0">{{$title}}</h4>
						</div>
						<div class="card-block">
							<p>{!! __('license.create.note') !!}</p>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="card">
						<div class="card-block">
							<form action="{{$action}}" method="post">
								@csrf
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="col-form-label">{{__('license.store.field.name')}}</label>
										<input type="text" class="form-control" name="name" value="{{$license->name ?? $currentUser->name}}" readonly>
										<input type="hidden" class="form-control" name="user_id" value="{{old('user_id', $license->user_id ?? $currentUser->id)}}">
										<input type="hidden" class="form-control" name="approver" value="{{$approver ? $approver->id : '' }}">
									</div>
									@foreach($fields as $field)
									<div class="col-sm-6">
										<label class="col-form-label">{{$field->name}}</label>
										<select class="form-control" name="{{$field->field_code}}">
										@if(isset($field->terms) && count($field->terms))
											@foreach($field->terms as $term)
												<option value="{{$term->id}}" {{old($field->field_code, (isset($license) && $license->{$field->field_code}) ? $license->{$field->field_code} : '') == $term->id ? 'selected' : ''}}>{{$term->name}}</option>
											@endforeach
										@endif
										</select>
									</div>
									@endforeach
									{{-- <div class="col-sm-6">
										<label class=" col-form-label">{{__('license.store.field.approver')}}</label>
										<input type="text" class="form-control @error('code') form-control-danger @enderror" value="{{$approver ? $approver->name : '' }}" readonly>
									</div> --}}
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="col-form-label">{{__('license.store.field.unit.label')}}</label>
										<select name="license_unit" class="form-control">
										@foreach(__('license.store.field.unit.value') as $key => $val)
											<option value="{{$key}}" {{old('license_unit', (isset($license) && $license->license_unit) ? $license->license_unit : '') == $key ? 'selected' : ''}}>{{$val}}</option>
										@endforeach
										</select>
									</div>
									<div class="col-sm-6">
										<label class=" col-form-label">{{__('license.store.field.duration.label')}}</label>
										<select name="license_duration" class="form-control">
										@foreach(__('license.store.field.duration.value') as $key => $val)
											<option value="{{$key}}" {{old('license_duration', (isset($license) && $license->license_duration) ? $license->license_duration : '') == $key ? 'selected' : ''}}>{{$val}}</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
								@php 
									$start_date = isset($license->start_date) ? formatDate($license->start_date, 'd/m/Y') : '';  
									$end_date = isset($license->end_date) ? formatDate($license->end_date, 'd/m/Y') : '';  
								@endphp
									<div class="col-sm-6">
										<label class="col-form-label">{{__('license.store.field.start_date')}}&nbsp;<span class="text-danger">(*)</span></label>
										<div class="input-group date mb-0" id="start_date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" name="start_date" value="{{old('start_date', $start_date)}}">
										</div>
										@error('start_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
									<div class="col-sm-6 d-none col-end-date">
										<label class=" col-form-label">{{__('license.store.field.end_date')}}&nbsp;<span class="text-danger">(*)</span></label>
										<div class="input-group date mb-0" id="end_date">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											<input type="text" class="form-control" name="end_date" value="{{old('end_date', $end_date)}}">
										</div>
										@error('end_date')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="col-form-label">{{__('license.store.field.reason')}}</label>
										<textarea rows="2" name="reason_leave" class="form-control"></textarea>
										@error('reason_leave')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
								</div>
								<div class="action text-center">
									<a href="{{route('license.view')}}" class="btn btn-outline-primary waves-effect waves-light">{{__('general.button.cancel')}}</a>
									<button type="submit" class="btn btn-primary waves-effect waves-light">{{__('general.button.save')}}</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	let leave_multiple = @json(\App\Constants\Number::NGHI_NHIEU_NGAY);
	let leave_full_day = @json(\App\Constants\Number::NGHI_CA_NGAY);
</script>