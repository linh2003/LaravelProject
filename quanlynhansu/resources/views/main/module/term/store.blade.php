@include(
	'main.components.breadcrumb',
	[
		'url' => 'term.view',
		'breadcrumb_before' => 'Term manage',
		'breadcrumb_after'  => (isset($method) && $method=='create') ? 'Add new term' : 'Update term'
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			@php
				$action = isset($method) && $method=='create' ? route('term.store') : route('term.update', $term->id);
				$title = isset($method) && $method=='create' ? 'Add new term' : 'Update term';
			@endphp
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-header">
							<h4 class="mb-0">{{$title}}</h4>
						</div>
						<div class="card-block">
							<p>{!! __('term.create.note') !!}</p>
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
										<label class="col-form-label">Term name&nbsp;<span class="text-danger">(*)</span></label>
										<input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" value="{{old('name', $term->name ?? '')}}">
										@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
									<div class="col-sm-6">
										<label class=" col-form-label">Term code&nbsp;<span class="text-danger">(*)</span></label>
										<input type="text" class="form-control @error('code') form-control-danger @enderror" name="code" value="{{old('code', $term->code ?? '')}}">
										@error('code')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="col-form-label">Vocabulary&nbsp;<span class="text-danger">(*)</span></label>
										<select class="form-control setupSelect2 vocabulary_id" name="vocabulary_id">
											<option value="">-- Select --</option>
											@foreach($vocs as $voc)
											<option value="{{$voc->id}}" {{old('vocabulary_id', $term->vocabulary_id ?? '') == $voc->id ? 'selected' : ''}}>{{$voc->name}}</option>
											@endforeach
										</select>
										@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
									</div>
									<div class="col-sm-6">
										<label class="col-form-label d-block">Publish</label>
										@if(isset($method) && $method=='create')
										<input type="checkbox" class="js-switch status" name="publish" value="1" checked />
										@else
										<input type="checkbox" class="js-switch status" name="publish" value="{{$term->publish ?? ''}}" @if(isset($term->publish) && $term->publish == \App\Constants\Number::PUBLISH) checked @endif />
										@endif
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
										<label class="col-form-label">Description</label>
										<textarea rows="2" class="form-control" name="description">{{old('description', $term->description ?? '')}}</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-form-label">Rules</label>
									<div class="row">
										<div class="col-sm-12 rule-list">
											
										</div>
									</div>
									<button type="button" class="btn btn-primary prn-0 mrn-0 meta-add-new"><i class="icofont icofont-plus"></i></button>
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