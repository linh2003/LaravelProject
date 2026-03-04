@include(
	'main.components.breadcrumb',
	[
		'url' => 'vocabulary.view',
		'breadcrumb_before' => 'Vocabulary manage',
		'breadcrumb_after'  => (isset($method) && $method=='create') ? 'Add new vocabulary' : 'Update vocabulary'
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			@php
				$action = isset($method) && $method=='create' ? route('vocabulary.store') : route('vocabulary.update', $vocabulary->id);
				$title = isset($method) && $method=='create' ? 'Add new vocabulary' : 'Update vocabulary';
				$description = isset($method) && $method=='create' ? __('vocabulary.create.description') : __('vocabulary.update.description');
			@endphp
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-header">
							<h4 class="mb-0">{{$title}}</h4>
						</div>
						<div class="card-block">
							<p>{!! __('vocabulary.create.note') !!}</p>
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
										<label class="col-form-label">Vocabulary name&nbsp;<span class="text-danger">(*)</span></label>
										<input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" value="{{old('name', $vocabulary->name ?? '')}}">
										@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
									<div class="col-sm-6">
										<label class=" col-form-label">Vocabulary code&nbsp;<span class="text-danger">(*)</span></label>
										<input type="text" class="form-control @error('code') form-control-danger @enderror" name="code" value="{{old('code', $vocabulary->machine_name ?? '')}}">
										@error('code')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
								</div>
								<div class="form-group">
									<label class="col-form-label">Description</label>
									<textarea class="form-control" name="description" rows="2">{{old('description', $vocabulary->description ?? '')}}</textarea>
								</div>
								<div class="action text-right">
									<a href="{{route('vocabulary.view')}}" class="btn btn-outline-primary waves-effect waves-light">{{__('general.button.cancel')}}</a>
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