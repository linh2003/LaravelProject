<div id="tab-1" class="tab-pane active">
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Tiêu đề bài viết&nbsp;<span class="text-danger">(*)</span></label>
				<input type="text" placeholder="Tiêu đề bài viết" class="form-control" name="name" value="{{ old('name',($posts->name) ?? '') }}" />
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Chọn danh mục cha&nbsp;<span class="text-danger">(*)</span><span class="text-danger notice">* Chọn Root nếu không có danh mục cha</span></label>
				<select name="post_catalogue_id" class="fomr-control setupSelect2">
				@foreach($dropdown as $k => $d)
					<option value="{{$k}}" {{$k==old('post_catalogue_id',(isset($posts->post_catalogue_id))?$posts->post_catalogue_id:'')?'selected':''}}>{{$d}}</option>
				@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Chọn danh mục phụ&nbsp;</label>
				@php 
					$catalogue = [];
					if(isset($posts->post_catalogues)){
						foreach($posts->post_catalogues as $k => $val){
							$catalogue[] = $val->id;
						}
					}
				@endphp
				
				<select multiple name="catalogue[]" class="fomr-control setupSelect2">
				@foreach($dropdown as $k => $d)
					<option value="{{$k}}" @if(isset($posts->post_catalogue_id) && is_array(old('catalogue',(isset($catalogue) && count($catalogue))?$catalogue:[])) && ($k != $posts->post_catalogue_id) && in_array($k,old('catalogue',(isset($catalogue) && count($catalogue))?$catalogue:[]))) selected  @endif>{{$d}}</option>
				@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">Mô tả ngắn</label>
				<textarea class="form-control ck-editor" id="description" name="description" data-height="250">{{ old('description',($posts->description) ?? '') }}</textarea>
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
				<textarea class="form-control ck-editor" id="ckContent" name="content" data-height="500">{{ old('content',($posts->content) ?? '') }}</textarea>
				<span class="baseUrl baseUrl-custom">{{asset('')}}</span>
			</div>
		</div>
	</div>
</div>