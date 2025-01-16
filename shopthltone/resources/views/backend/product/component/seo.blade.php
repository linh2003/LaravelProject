<div id="tab-2" class="tab-pane">
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6"><label class="control-label"><span>Tiêu đề SEO</span></label></div>
					<div class="col-sm-6 text-right"><span class="count_meta-title"><span class="text-danger text-bold">0</span> ký tự</span></div>
				</div>
				<input type="text" placeholder="" class="form-control" name="meta_title" value="{{ old('meta_title',($product->meta_title) ?? '') }}" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label text-left">
					<span>Từ khóa SEO</span>
				</label>
				<input type="text" placeholder="" class="form-control" name="meta_keyword" value="{{ old('meta_keyword',($product->meta_keyword) ?? '') }}" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6"><label class="control-label"><span>Mô tả SEO</span></label></div>
					<div class="col-sm-6 text-right"><span class="count_meta-title"><span class="text-danger text-bold">0</span> ký tự</span></div>
				</div>
				<textarea class="form-control" id="meta_description" name="meta_desc" rows="8">{{ old('meta_desc',($product->meta_desc) ?? '') }}</textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label text-left">
					<span>Đường dẫn</span>
				</label>
				<div class="canonical-wrapper">
					<input type="text" placeholder="" class="form-control" name="canonical" value="{{ old('canonical',($product->canonical) ?? '') }}" />
					<span class="baseUrl">{{asset('')}}</span>
				</div>
			</div>
		</div>
	</div>
</div>