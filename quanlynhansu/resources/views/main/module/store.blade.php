@include(
	'main.components.breadcrumb',
	[
		'url' => 'module.view',
		'breadcrumb_before' => 'Module manage',
		'breadcrumb_after'  => (isset($method) && $method=='create') ? 'Add new module' : 'Update module'
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			@php
				$action = isset($method) && $method=='create' ? route('module.store') : route('module.update', $module->id);
				$title = (isset($method) && $method=='create') ? 'Add new module' : 'Update module';
			@endphp
			<div class="card">
			    <div class="card-header">
			        <h5>{{$title}}</h5>
			    </div>
			    <div class="card-block">
			        <form action="{{$action}}" method="post">
						@csrf
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Module name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" placeholder="Enter Module Name">
										@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Description</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="description" rows="2"></textarea>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Machine name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control @error('code') form-control-danger @enderror" name="code" placeholder="Enter machine name">
										@error('code')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Publish</label>
									<div class="col-sm-10 col-form-label">
										<input type="checkbox" class="js-switch js-small" name="publish" checked value="1">
									</div>
								</div>
							</div>
							<div class="form-group col-sm-12 text-right">
								<button type="submit" class="btn btn-primary m-b-0">
									<i class="feather icon-check"></i>
									<span>Save</span>
								</button>
							</div>
						</div>
			        </form>
			    </div>
			</div>
		</div>
	</div>
</div>