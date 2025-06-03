<div class="ibox">
	<div class="ibox-title"><h5>{{$heading['create']['field']['attribute_type']}}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					@php 
						$catalogue = [];
						if(isset($attribute->attribute_types)){
							foreach($attribute->attribute_types as $k => $val){
								$catalogue[] = $val->id;
							}
						}
					@endphp
					<select multiple name="attributeType[]" class="form-control setupSelect2">
					
					@foreach($attributeTypes as $k => $d)
						<option value="{{$d->id}}" @if(in_array($d->id,old('attributeType',(isset($catalogue) && count($catalogue))?$catalogue:[]))) selected  @endif>{{$d->name}}</option>
					@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5></h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">				
					<span class="image img-cover image-target">
						<img src="{{old('image', isset($attribute->image) ? $attribute->image : null) ?? asset('backend/images/not-found.jpg')}}" alt="" />
					</span>
					<input type="hidden" name="image" value="{{old('image', isset($attribute->image) ? $attribute->image : null)}}" />
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
					<select name="publish" class="form-control {{old('publish')}}">
						@foreach(__('general.publish') as $k => $val)
						<option value="{{$k}}" {{$k==old('publish',(isset($attribute->publish))?$attribute->publish:'')?'selected':''}}>{{$val}}</option>
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
					<select name="follow" class="form-control {{old('follow')}}">
						@foreach(__('general.follow') as $k => $val)
						<option value="{{$k}}" {{$k==old('follow',(isset($attribute->follow))?$attribute->follow:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>