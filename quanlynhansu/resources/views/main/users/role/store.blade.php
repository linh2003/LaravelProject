@php
	$action = isset($method) && $method=='create' ? route('role.store') : route('role.update', $role->id);
	$title = isset($method) && $method=='create' ? __('role.create.title') : __('role.update.title');
	$description = isset($method) && $method=='create' ? __('role.create.description') : __('role.update.description');
@endphp
<div class="row">
	<div class="col-sm-4">
		<div class="card">
			<div class="card-header">
				<h4 class="mb-0">{{$title}}</h4>
			</div>
			<div class="card-block">
				<p>{{$description}}</p>
				<p>{!! __('role.create.note') !!}</p>
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
							<label class="col-form-label">{{__('role.create.field.name')}}&nbsp;<span class="text-danger">(*)</span></label>
							<input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" value="{{old('name', $role->name ?? '')}}">
							@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
						</div>
						<div class="col-sm-6">
							<label class=" col-form-label">{{__('role.create.field.code')}}&nbsp;<span class="text-danger">(*)</span></label>
							<input type="text" class="form-control @error('code') form-control-danger @enderror" name="code" value="{{old('code', $role->machine_name ?? '')}}">
							@error('code')<div class="alert alert-danger">{{ $message }}</div>@enderror
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">{{__('role.create.field.description')}}</label>
						<textarea class="form-control" name="description" rows="2">{{old('description', $role->description ?? '')}}</textarea>
					</div>
					<div class="action text-right">
						<a href="{{route('role.view')}}" class="btn btn-outline-primary waves-effect waves-light">{{__('general.button.cancel')}}</a>
						<button type="submit" class="btn btn-primary waves-effect waves-light">{{__('general.button.save')}}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>