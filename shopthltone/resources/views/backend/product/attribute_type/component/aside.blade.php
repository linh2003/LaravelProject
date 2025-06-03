
<div class="ibox">
	<div class="ibox-title"><h5>{{$heading['create']['field']['publish']}}</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<select name="publish" class="form-control {{old('publish')}}">
						@foreach(__('general.publish') as $k => $val)
						<option value="{{$k}}" {{$k==old('publish',(isset($attributeType->publish))?$attributeType->publish:'')?'selected':''}}>{{$val}}</option>
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
						<option value="{{$k}}" {{$k==old('follow',(isset($attributeType->follow))?$attributeType->follow:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>