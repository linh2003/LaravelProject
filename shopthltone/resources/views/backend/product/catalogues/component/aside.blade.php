
<div class="ibox">
	<div class="ibox-title"><h5>Image</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">				
					<span class="image img-cover image-target">
					@if(isset($productCat->image))
						<img src="{{(old('image',$productCat->image)??asset('backend/images/not-found.jpg'))}}" alt="image" />
					@else
						<img src="{{(old('image')??asset('backend/images/not-found.jpg'))}}" alt="image" />
					@endif
					</span>
					<input type="hidden" name="image" class="" value="{{old('image',(isset($productCat->image))?$productCat->image:'')}}" />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5>{{ __('general.publish.title') }}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<select name="publish" class="form-control {{old('publish')}}">
						<option value="0">-- Chọn tình trạng --</option>
						@foreach(__('general.publish.content') as $k => $val)
						<option value="{{$k}}" {{$k==old('publish',(isset($productCat->publish))?$productCat->publish:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5>{{ __('general.follow.title') }}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<select name="follow" class="form-control {{old('publish')}}">
						<option value="0">-- Chọn tình trạng --</option>
						@foreach(__('general.follow.content') as $k => $val)
						<option value="{{$k}}" {{$k==old('publish',(isset($productCat->publish))?$productCat->publish:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>