<div class="ibox">
	<div class="ibox-title"><h5>Nhóm thuộc tính</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					@php 
						$catalogue = [];
						if(isset($data->attribute_types)){
							foreach($data->attribute_types as $k => $val){
								$catalogue[] = $val->id;
							}
						}
					@endphp
					<select multiple name="attributeType[]" class="form-control setupSelect2">
					@foreach($dropdown as $k => $d)
						<option value="{{$k}}" @if(in_array($k,old('attributeType',(isset($catalogue) && count($catalogue))?$catalogue:[]))) selected  @endif>{{$d}}</option>
					@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5>Image</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">				
					<span class="image img-cover image-target">
						@if(isset($data->image))
							<img src="{{(old('image',$data->image)??asset('backend/images/not-found.jpg'))}}" alt="image" />
						@else
							<img src="{{(old('image')??asset('backend/images/not-found.jpg'))}}" alt="image" />
						@endif
					</span>
					<input type="hidden" name="image" class="" value="{{old('image',(isset($data->image))?$data->image:'')}}" />
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
						@foreach(__('general.publish.content') as $k => $val)
						<option value="{{$k}}" {{$k==old('publish',(isset($data->publish))?$data->publish:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>