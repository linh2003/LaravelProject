@include(
	'main.components.breadcrumb',
	[
		'url' => 'term.view',
		'breadcrumb_before' => 'Term manage',
		'breadcrumb_after'  => 'Translate term'
	]
)
<div class="pcoded-inner-content">
	<div class="main-body">
		<div class="page-wrapper">
			<div class="row">
				<div class="col-sm-4">
					<div class="card">
						<div class="card-header">
							<h4 class="mb-0">Translate term</h4>
						</div>
						<div class="card-block">
							<p>{!! __('term.create.note') !!}</p>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="card">
						<div class="card-block">
							<div class="row">
								<div class="col-sm-6">
									<div class="text-center"><img src="{{asset($languageFrom->first()->image)}}" alt="{{$languageFrom->first()->name}}" class="icon-language" /></div>
									<div class="form-group">
										<label class="col-form-label">Term name&nbsp;</label>
										<input type="text" class="form-control" value="{{$data->name}}" readonly>
									</div>
									<div class="form-group">
										<label class="col-form-label">Description</label>
										<textarea class="form-control" rows="2" readonly>{{$data->description}}</textarea>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="text-center"><img src="{{asset($languageTo->image)}}" alt="{{$languageTo->name}}" class="icon-language" /></div>
									<form action="{{route('language.storetranslate', ['id' => $data->id, 'languageid' => $languageTo->id, 'model' => 'term'])}}" method="post">
										@csrf
										<div class="form-group">
											<label class="col-form-label">Term name&nbsp;<span class="text-danger">(*)</span></label>
											<input type="text" class="form-control @error('name') form-control-danger @enderror" name="name" value="{{old('name', $translate->name ?? '')}}">
											@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
											<input type="hidden" name="code" value="{{$data->code ?? ''}}">
										</div>
										<div class="form-group">
											<label class="col-form-label">Description</label>
											<textarea class="form-control" name="description" rows="2">{{old('description', $translate->description ?? '')}}</textarea>
										</div>
										<div class="action text-right">
											<a href="{{route('term.view')}}" class="btn btn-outline-primary waves-effect waves-light">{{__('general.button.cancel')}}</a>
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
	</div>
</div>