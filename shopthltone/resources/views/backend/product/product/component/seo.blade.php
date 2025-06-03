<div id="tab-2" class="tab-pane">
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['meta_title']}}&nbsp;</label>
				<input type="text" placeholder="{{$heading['create']['field']['meta_title']}}" class="form-control" name="meta_title" value="{{ old('meta_title', isset($data->meta_title) ? $data->meta_title : null)}}" />
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['meta_keyword']}}&nbsp;</label>
				<input type="text" placeholder="{{$heading['create']['field']['meta_keyword']}}" class="form-control" name="meta_keyword" value="{{ old('meta_keyword', isset($data->meta_keyword) ? $data->meta_keyword : null)}}" />
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['meta_description']}}&nbsp;</label>
				<textarea class="form-control" id="meta_description" name="meta_description">
					{{old('meta_description', isset($data->meta_description) ? $data->meta_description : null)}}
				</textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label text-left">
					<span>{{$heading['create']['field']['canonical']}}</span><span class="text-danger">(*)</span>
				</label>
				<div class="canonical-wrapper">
					<input type="text" placeholder="" class="form-control" name="canonical" value="{{ old('canonical', isset($data->canonical) ? $data->canonical : null) }}" />
					<span class="baseUrl">{{asset('')}}</span>
				</div>
			</div>
		</div>
	</div>
</div>