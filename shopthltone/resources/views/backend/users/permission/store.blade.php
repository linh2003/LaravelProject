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
				<p>- {{ (isset($method) && $method=='create') ? $heading['create']['description'] : $heading['update']['description'] }} </p>
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
					$action = (isset($method) && $method=='create') ? route('user.permission.store') : route('user.permission.update',$permission->id)
				@endphp
                    <form method="POST" action="{{ $action }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Phân quyền&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Team member name" class="form-control" name="name" value="{{ old('name',($permission->name) ?? '') }}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Machine name&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Machine name" class="form-control" name="canonical" value="{{ old('slug',($permission->canonical) ?? '') }}" />
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <textarea placeholder="Address" class="form-control" name="description" rows="1">{{ old('description',($permission->description) ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-white" name="cancel">Cancel</a>
                            <button class="btn btn-primary" type="submit" name="send" value="send">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>