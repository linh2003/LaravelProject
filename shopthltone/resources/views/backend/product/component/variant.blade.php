<div id="tab-4" class="tab-pane">
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="variant-header"><label class="control-label">Chọn thuộc tính sản phẩm&nbsp;</label></div>
				<div class="variant-body product-variant-type">
				@if(old('attributeType'))
					@foreach(old('attributeType') as $kAttr => $valAttr)
					<div class="row variant-item">
						<div class="col-sm-3">
							<select class="form-control setupSelect2 choose-attribute" name="attributeType[]">
								<option value="0">-- Chọn thuộc tính --</option>
								@foreach($attrs as $k => $it)
								<option value="{{ $it->id }}" {{($valAttr == $it->id) ? 'selected' : '' }}>{{$it->attribute_type_languages->first()->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-8">
							{{-- <input type="text" name="variant" class="form-control" disabled /> --}}
							<select name="attribute[{{$valAttr}}][]" class="selectVariant variant-{{$valAttr}} form-control" multiple data-catid="{{$valAttr}}"></select>
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-outline btn-danger dim remove-attribute"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
						</div>
					</div>
					@endforeach
				@endif
				</div>
				<div class="variant-footer m-b-xl">
					<button type="button" class="btn btn-primary add-variant">Thêm thuộc tính mới</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Danh sách phiên bản&nbsp;</label>
				<div class="table-responsive">
					<table class="table table-striped variantTable">
						<thead></thead>
						<tbody></tbody>
					</table>
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var attributeTypes = @json($attrs->map(function($item) {
		$name = $item->attribute_type_languages->first()->name;
		return [
			'id' 	=> $item->id,
			'name' 	=> $name,
		];
	})->values());
	var attribute = '{{ base64_encode(json_encode(old('attribute'))) }}';
	var variant = '{{ base64_encode(json_encode(old('variant'))) }}';
</script>