
<div class="ibox">
	<div class="ibox-title"><h5>Image</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">				
					<span class="image img-cover image-target">
						@if(isset($attributeType->image))
							<img src="{{(old('image',$attributeType->image)??asset('backend/images/not-found.jpg'))}}" alt="image" />
						@else
							<img src="{{(old('image')??asset('backend/images/not-found.jpg'))}}" alt="image" />
						@endif
					</span>
					<input type="hidden" name="image" class="" value="{{old('image',(isset($attributeType->image))?$attributeType->image:'')}}" />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5>Publish</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
				
					<select name="publish" class="form-control {{old('publish')}}">
						<option value="0">-- Chọn tình trạng --</option>
						@foreach(__('general.publish') as $k => $val)
						<option value="{{$k}}" {{$k==old('publish',(isset($attributeType->publish))?$attributeType->publish:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>