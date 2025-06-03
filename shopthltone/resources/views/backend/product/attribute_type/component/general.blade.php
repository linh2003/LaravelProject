
<div id="tab-1" class="tab-pane active">
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['name']}}&nbsp;<span class="text-danger">(*)</span></label>
				<input type="text" placeholder="{{$heading['create']['field']['name']}}" class="form-control" name="name" value="{{ old('name',($attributeType->name) ?? '') }}" />
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<label class="control-label">{{$heading['create']['field']['description']}}</label>
				<textarea class="form-control ck-editor" id="description" name="description" data-height="250">{{ old('description',($attributeType->description) ?? '') }}</textarea>
			</div>
		</div>
	</div>
	<div class="row mb15">
		<div class="col-lg-12">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6"><label class="control-label">{{$heading['create']['field']['content']}}&nbsp;</label></div>
					<div class="col-sm-6 text-right m-b"><a href="" class="multipleUploadImageCkeditor" data-target="ckContent">Upload nhiều ảnh</a></div>
				</div>
				<textarea class="form-control ck-editor" id="ckContent" name="content" data-height="500">{{ old('content',($attributeType->content) ?? '') }}</textarea>
				<span class="baseUrl baseUrl-custom">{{asset('')}}</span>
			</div>
		</div>
	</div>
</div>