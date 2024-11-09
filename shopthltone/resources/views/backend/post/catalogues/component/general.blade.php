<div id="tab-1" class="tab-pane active">
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Tiêu đề nhóm bài viết&nbsp;<span class="text-danger">(*)</span></label>
				<input type="text" placeholder="Tiêu đề nhóm bài viết" class="form-control" name="name" value="{{ old('name',($postCat->name) ?? '') }}" />
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Chọn danh mục cha&nbsp;<span class="text-danger">(*)</span><span class="text-danger notice">* Chọn Root nếu không có danh mục cha</span></label>
				<select name="parentid" class="fomr-control setupSelect2">
				@foreach($dropdown as $k => $d)
					<option value="{{$k}}" {{$k==old('parentid',(isset($postCat->parentid))?$postCat->parentid:'')?'selected':''}}>{{$d}}</option>
				@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Mô tả ngắn</label>
				<textarea class="form-control ck-editor" id="description" name="description" data-height="250">{{ old('description',($postCat->description) ?? '') }}</textarea>
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6"><label class="control-label">Nội dung&nbsp;</label></div>
					<div class="col-sm-6 text-right m-b"><a href="" class="multipleUploadImageCkeditor" data-target="ckContent">Upload nhiều ảnh</a></div>
				</div>
				<textarea class="form-control ck-editor" id="ckContent" name="content" data-height="500">{{ old('content',($postCat->content) ?? '') }}</textarea>
				<span class="baseUrl baseUrl-custom">{{asset('')}}</span>
			</div>
		</div>
	</div>
</div>