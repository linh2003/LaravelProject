@php
	$action = isset($method) && $method=='create' ? route('permission.store') : route('permission.update', $permission->id);
	$title = isset($method) && $method=='create' ? __('permission.create.title') : __('permission.update.title');
	$description = isset($method) && $method=='create' ? __('permission.create.description') : __('permission.update.description');
@endphp
<div class="row">
	<div class="col-sm-4">
		<div class="card">
			<div class="card-header">
				<h4 class="mb-0">{{$title}}</h4>
			</div>
			<div class="card-block">
				<p>{{$description}}</p>
				<p>{!! __('permission.create.note') !!}</p>
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
							<label class="col-form-label">{{__('permission.create.field.name')}}&nbsp;<span class="text-danger">(*)</span></label>
							<input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" value="{{old('name', $permission->name ?? '')}}">
							@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
						</div>
						<div class="col-sm-6">
							<label class=" col-form-label">{{__('permission.create.field.canonical')}}&nbsp;<span class="text-danger">(*)</span></label>
							<input type="text" class="form-control @error('canonical') form-control-danger @enderror" name="canonical" value="{{old('canonical', $permission->canonical ?? '')}}">
							@error('canonical')<div class="alert alert-danger">{{ $message }}</div>@enderror
						</div>
					</div>
					<div class="form-group">
						<label class="col-form-label">{{__('permission.create.field.description')}}</label>
						<textarea class="form-control" name="description" rows="2">{{old('description', $permission->description ?? '')}}</textarea>
					</div>
					<div class="action text-right">
						<a href="{{route('permission.view')}}" class="btn btn-outline-primary waves-effect waves-light">{{__('general.button.cancel')}}</a>
						<button type="submit" class="btn btn-primary waves-effect waves-light">{{__('general.button.save')}}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>