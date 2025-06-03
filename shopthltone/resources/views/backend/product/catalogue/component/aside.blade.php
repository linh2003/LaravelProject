<div class="ibox">
	<div class="ibox-title"><h5>Image</h5></div>
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