
<div class="ibox">
	<div class="ibox-title"><h5>Thumbnail</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">				
					<span class="image img-cover image-target">
					@if(isset($postCat->thumbnail))
						<img src="{{(old('thumbnail',$postCat->thumbnail)??asset('backend/images/not-found.jpg'))}}" alt="thumbnail" />
					@else
						<img src="{{(old('thumbnail')??asset('backend/images/not-found.jpg'))}}" alt="thumbnail" />
					@endif
					</span>
					<input type="hidden" name="thumbnail" class="" value="{{old('thumbnail',(isset($postCat->thumbnail))?$postCat->thumbnail:'')}}" />
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
						@foreach(config('apps.general.publish') as $k => $val)
						<option value="{{$k}}" {{$k==old('publish',(isset($postCat->publish))?$postCat->publish:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>