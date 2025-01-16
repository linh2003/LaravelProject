<div class="ibox">
	<div class="ibox-title"><h5>Thông tin</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label">Mã sản phẩm&nbsp;</label>
					<input type="text" name="code" value="{{old('code', (isset($product->code)) ? $product->code : time())}}" class="form-control" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label">Giá sản phẩm&nbsp;</label>
					<input type="text" name="price" value="{{old('price', (isset($product->price)) ? (number_format($product->price, 0, ',', '.')) : null)}}" class="form-control int" />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ibox">
	<div class="ibox-title"><h5>Danh mục</h5></div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="control-label">Chọn danh mục&nbsp;</label>
					@php 
						$catalogue = [];
						if(isset($product->product_catalogues)){
							foreach($product->product_catalogues as $k => $val){
								$catalogue[] = $val->id;
							}
						}
					@endphp
					
					<select multiple name="catalogue[]" class="form-control setupSelect2">
					@foreach($dropdown as $k => $d)
						<option value="{{$k}}" @if(is_array(old('catalogue',(isset($catalogue) && count($catalogue))?$catalogue:[])) && ($k != 0) && in_array($k,old('catalogue',(isset($catalogue) && count($catalogue))?$catalogue:[]))) selected  @endif>{{$d}}</option>
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
						@if(isset($product->image))
							<img src="{{(old('image',$product->image)??asset('backend/images/not-found.jpg'))}}" alt="image" />
						@else
							<img src="{{(old('image')??asset('backend/images/not-found.jpg'))}}" alt="image" />
						@endif
					</span>
					<input type="hidden" name="image" class="" value="{{old('image',(isset($product->image))?$product->image:'')}}" />
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
						<option value="{{$k}}" {{$k==old('publish',(isset($product->publish))?$product->publish:'')?'selected':''}}>{{$val}}</option>
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
						<option value="{{$k}}" {{$k==old('publish',(isset($product->publish))?$product->publish:'')?'selected':''}}>{{$val}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
</div>