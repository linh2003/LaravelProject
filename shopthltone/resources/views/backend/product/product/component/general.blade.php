<div id="tab-1" class="tab-pane active">
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['name']}}&nbsp;<span class="text-danger">(*)</span></label>
				<input type="text" name="name" class="form-control data-target-canonical" placeholder="{{$heading['create']['field']['name']}}" value="{{old('name', isset($data->name) ? $data->name : null)}}" />
			</div>
		</div>
	</div>
	@if(isset($dropdown))
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['product_catalogue']}}&nbsp;<span class="text-danger">(*)</span></label>
				<select name="product_catalogue_id" class="form-control setupSelect2 {{ old('product_catalogue_id', isset($data->product_catalogue_id) ? $data->product_catalogue_id : null) }}">
				@foreach($dropdown as $k => $d)
					<option value="{{$k}}" {{ old('product_catalogue_id', isset($data->product_catalogue_id) ? $data->product_catalogue_id : null) == $k ? 'selected' : '' }}>{{$d}}</option>
				@endforeach
				</select>
			</div>
		</div>
	</div>
	@endif
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['description']}}&nbsp;</label>
				<textarea class="form-control ck-editor" id="description" name="description">
					{{old('description', isset($data->description) ? $data->description : null)}}
				</textarea>
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['content']}}&nbsp;</label>
				<textarea class="form-control ck-editor" id="content" name="content">
					{{old('content', isset($data->content) ? $data->content : null)}}
				</textarea>
				<span class="baseUrl baseUrl-custom">{{asset('')}}</span>
			</div>
		</div>
	</div>
</div>