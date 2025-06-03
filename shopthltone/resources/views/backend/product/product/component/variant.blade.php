@php 
	$applyVariant = old('apply_variant', (isset($data) && isset($data->variant) && !empty($data->variant)) ? 'on' : '');
	$variants = old('variant', (isset($data) && isset($data->variant)) ? json_decode($data->variant) : '');
	$attributeVariant = old('attribute', (isset($data) && isset($data->attribute)) ? json_decode($data->attribute) : '');
@endphp
<div id="tab-4" class="tab-pane">
	<div class="row">
		<div class="col-lg-12">
			<p>{{$heading['variant']['description']}}</p>
			<label class="apply-variant">
				<input type="checkbox" class=" i-checks" name="apply_variant" {{ $applyVariant == true ? 'checked' : '' }}  />
				<span>&nbsp; {{$heading['variant']['checkbox']}} </span>
			</label>
			<div class="variant-wrapper {{ $applyVariant == true ? '' : 'hide' }}">
				<div class="row mt15 mb15 variant-label">
					<div class="col-sm-3 padding-not-right"><label>{{$heading['variant']['variantLabelLeft']}}</label></div>
					<div class="col-sm-8 padding-not-right"><label>{{$heading['variant']['variantLabelCenter']}}</label></div>
					<div class="col-sm-1 padding-not-right"><label>&nbsp;</label></div>
				</div>
				<div class="border-radius-not-element variant-body">
					@if(old('attribute', $attributeVariant))
						@foreach(old('attribute', $attributeVariant) as $k => $attr)
						<div class="row variant-item">
							<div class="col-sm-3 mb15 padding-not-right attributeTypeVariant">
								<select name="attributeTypeVariant[]" class="form-control setupSelect2 selectAttributeTypeVariant">
									<option value="0">{{$heading['variant']['script']['defaultAttributeType']}}</option>
									@foreach($attributeTypes as $atType)
									<option value="{{$atType->id}}" {{$k == $atType->id ? 'selected' : ''}}>{{$atType->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-8 mb15 padding-not-right attributeVariant">
								<select name="attribute[{{$k}}][]" multiple class="form-control selectAttributeVariant selectAttributeByAttrType-{{$k}}" data-attributeType="{{$k}}">
								</select>
							</div>
							<div class="col-sm-1">
								<button type="button" class="btn btn-outline btn-danger dim remove-attribute"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
							</div>
						</div>
						@endforeach
					@endif
				</div>
				<div class="row variant-footer">
					<div class="col-lg-12">
						<button type="button" class="btn btn-danger action-add-variant"><span>{{$heading['variant']['buttonAdd']}}</span></button>
					</div>
				</div>
			</div>
			<div class="variant-table">
			</div>
		</div>
	</div>
</div>
<script>
	let attributeType = @json($attributeTypes->map(function($item){
		return [
			'id' => $item->id,
			'name' => $item->name,
		];
	})->values());
	let textVariantTranslate = @json($heading['variant']['script']);
	let attributeVariant = @json($attributeVariant);
	let variants = @json($variants);
	// console.log(variants);
</script>