@include(
	'backend.component.breadcrumb',
	[
		'breadcrumb_before' => $heading['index']['title'],
		'breadcrumb_after'  => (isset($method) && $method=='create') ? $heading['create']['title'] : $heading['update']['title']
	]
)
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel-title"> {{ (isset($method) && $method=='create') ? $heading['create']['title'] : $heading['update']['title'] }} </div>
			<div class="panel-description">
				<p>- Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là thông tin bắt buộc</p>
			</div>
			<div class="panel-message">
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
				@php
				$action = (isset($method) && $method=='create') ? route('admin.language.store') : route('admin.language.update',$language->id)
				@endphp
                    <form method="POST" action="{{ $action }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Tên ngôn ngữ&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Language" class="form-control" name="name" value="{{ old('name',($language->name) ?? '') }}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Canonical&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Canonical" class="form-control" name="canonical" value="{{ old('canonical',($language->canonical) ?? '') }}" />
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Author</label>
                                    <select name="user_id" class="form-control setupSelect2 roles-option">
										<option value="">-- Select author --</option>
										@foreach($users as $k => $u)
											@if($method=='create')
											<option value="{{$u->id}}" {{$u->id==$uidLogged?'selected':''}}>{{$u->fullname}} - {{$u->name}}</option>
											@else
											<option value="{{$u->id}}" {{$language->user_id==$u->id?'selected':''}}>{{$u->fullname}} - {{$u->name}}</option>
											@endif
										@endforeach
									</select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
									<label class="control-label">Image</label>
                                    <!--<div class="fileinput fileinput-new input-group" data-provides="fileinput">
										<div class="form-control url-image" data-trigger="fileinput">
											<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
										</div>
										<span class="input-group-addon btn btn-default btn-file upload-image"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="image" class="ip-upload-image" data-type="Image"></span>
										<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>-->
									<input type="text" name="image" class="form-control upload-image" data-type="Images" value="{{ old('image',($language->image) ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-white" name="cancel">Cancel</a>
                            <button class="btn btn-primary" type="submit" name="send" value="send">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>