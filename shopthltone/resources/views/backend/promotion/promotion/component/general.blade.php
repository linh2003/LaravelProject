<div class="ibox float-e-margins">
	<div class="ibox-title">
		<h5>{{$heading['create']['titleBoxLeft']}}</h5>
	</div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['name']}}&nbsp;<span class="text-danger">(*)</span></label>
					<input type="text" placeholder="{{$heading['create']['field']['name']}}" class="form-control" name="name" value="{{ old('name',($promotion->name) ?? '') }}" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['code']}}<span class="text-danger">(*)</span></label>
					<input type="text" placeholder="{{$heading['create']['field']['code']}}" class="form-control" name="code" value="{{ old('code',($promotion->code) ?? '') }}" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['description']}}</label>
					<textarea name="description" rows="3" class="form-control">{{ old('description',($promotion->description) ?? '') }}</textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label class="control-label">{{$heading['create']['field']['type']['label']}}&nbsp;<span class="text-danger">(*)</span></label>
					<div class="form-group">
						<select name="type" class="form-control setupSelect2 choosenPromotionType">
						@foreach($heading['create']['field']['type']['option'] as $k => $val)
							<option value="{{$k}}" {{old('type', $promotion->type ?? null) == $k ? 'selected' : ''}}>{{$val}}</option>
						@endforeach
						</select>
					</div>
				</div>
				
				<div id="product" class="promotion-container {{old('type', isset($promotion->type) ? $promotion->type : null) == 'product' ? '' : 'hide'}}">
					<div class="form-group">
						<div class="radio radio-danger">
							<input type="radio" name="module" id="productPromotion" class="product-promotion-radio product-promotion-radio1" value="product" {{old('module', (isset($promotion) && $promotion->discount['module'] == 'product') ) ? 'checked' : ''}} data-module="product">
							<label for="productPromotion">{{$heading['create']['field']['type_option']['product']['radio'][0]}}</label>
						</div>
						<div class="radio radio-danger">
							<input type="radio" name="module" id="productPromotionCatalogue" class="product-promotion-radio product-promotion-radio2" {{old('module', ( isset($promotion) && $promotion->discount['module'] == 'productcatalogue') ) ? 'checked' : ''}} value="productcatalogue" data-module="productcatalogue">
							<label for="productPromotionCatalogue">{{$heading['create']['field']['type_option']['product']['radio'][1]}}</label>
						</div>
					</div>
					<table class="table table-striped promotionProduct {{old('module', (isset($promotion) && $promotion->discount['module'] != null)) ? '' : 'hide'}}">
						<thead>
							<tr>
								<th class="thead-name-promotion-product"></th>
								<th width="250px">{{$heading['create']['field']['type_option']['value_product']['discountValue']}}
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="product-quantity promotion-product" data-toggle="modal" data-target="#modalPromotionProduct">
										<div class="boxWrapper">
											<div class="boxSearchIcon">
												<i class="fa fa-search"></i>
											</div>
											
											<div class="boxSearchInput fixGrid6">
												<p>{{$heading['create']['field']['type_option']['product']['search']}}</p>
											</div>
										</div>
									</div>
								</td>
								<td width="250px">
									<div class="col-sm-9 padding-not-left padding-not-right">
										<input type="text" name="discount_promotion_product" class="form-control number" value="{{old('discount_promotion_product', isset($promotion) ? $promotion->discount['discount_promotion_product'] : '')}}" />
									</div>
									<div class="col-sm-3 padding-not-left padding-not-right">
										<select name="discount" class="form-control select-small">
										@foreach($heading['create']['field']['type_option']['value_product']['discount'] as $k => $val)
											<option value="{{$k}}" {{old('discount', (isset($promotion) && $promotion->discount['discount']) == $k) ? 'selected' : ''}}>{{$val}}</option>
											@endforeach
										</select>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div id="value_product" class="promotion-container {{old('type', $promotion->type ?? null) == 'value_product' ? '' : 'hide'}}">
					<table class="table table-striped promotionValueProduct">
						<thead>
							<tr>
								<th>{{$heading['create']['field']['type_option']['value_product']['begin']}}</th>
								<th>{{$heading['create']['field']['type_option']['value_product']['end']}}</th>
								<th>{{$heading['create']['field']['type_option']['value_product']['discountValue']}}</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<p class="promotion-value-error hide"></p>
					<button type="button" class="btn btn-danger add-promotion-value"><span>{{$heading['create']['field']['type_option']['value_product']['button']}}</span></button>
				</div>
			</div>
		</div>
	</div>
</div>