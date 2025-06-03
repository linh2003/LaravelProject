<div class="ibox">
	<div class="ibox-title"><h5>{{$heading['create']['field']['aside']['label']}}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['aside']['code']}}&nbsp;</label>
					<input type="text" name="code" value="{{old('code', (isset($data->code)) ? $data->code : time())}}" class="form-control" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['aside']['quantity']}}&nbsp;</label>
					<input type="text" name="quantity" value="{{old('quantity', (isset($data->quantity)) ? $data->quantity : 0)}}" class="form-control" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['aside']['price']}}&nbsp;</label>
					<input type="text" name="price" value="{{old('price', (isset($data->price)) ? (number_format($data->price, 0, ',', '.')) : null)}}" class="form-control number" />
				</div>
			</div>
		</div>
	</div>
</div>
@if(isset($dropdown))
<div class="ibox">
	<div class="ibox-title"><h5>{{$heading['create']['field']['catalogues']['title']}}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['catalogues']['label']}}&nbsp;</label>
					@php
						$catalogues = [];
						if(isset($data) && isset($data->product_catalogues)){
							foreach($data->product_catalogues as $key => $cat){
								if($cat->id != $data->product_catalogue_id){
									$catalogues[] = $cat->id;
								}
							}
						}
					@endphp
					<select multiple name="catalogues[]" class="form-control setupSelect2">
					@php $cats = old('catalogues', $catalogues) ?? []; @endphp
					@foreach($dropdown as $k => $d)
						@if($k==0) @continue @endif
						<option value="{{$k}}" {{in_array($k, $cats) ? 'selected' : ''}}>{{$d}}</option>
					@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<div class="ibox">
	<div class="ibox-title"><h5>{{$heading['create']['field']['image']}}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">				
					<span class="image img-cover image-target">
						<img src="{{old('image', isset($data->image) ? $data->image : null) ?? asset('backend/images/not-found.jpg')}}" alt="" />
					</span>
					<input type="hidden" name="image" value="{{old('image', isset($data->image) ? $data->image : null)}}" />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5>{{$heading['create']['field']['publish']}}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<select name="publish" class="form-control setupSelect2">
					@foreach($general['publish'] as $k => $val)
						<option value="{{$k}}" {{old('publish', isset($data->publish) ? $data->publish : null) == $k ? 'selected' : ''}}>{{$val}}</option>
					@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5>{{$heading['create']['field']['follow']}}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<select name="follow" class="form-control setupSelect2">
						@foreach($general['follow'] as $k => $val)
							<option value="{{$k}}" {{old('follow', isset($data->follow) ? $data->follow : null) == $k ? 'selected' : ''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>