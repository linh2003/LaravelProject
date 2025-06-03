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
				<p>{!! $heading['create']['note'] !!}</p>
			</div>
			@include('backend.component.message')
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
				@php
					$action = (isset($method) && $method=='create') ? route('permission.store') : route('permission.update',$permission->id)
				@endphp
                    <form method="POST" action="{{ $action }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">{{$heading['create']['field']['name']}}&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="{{$heading['create']['field']['name']}}" class="form-control" name="name" value="{{ old('name',($permission->name) ?? '') }}" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">{{$heading['create']['field']['canonical']}}&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="{{$heading['create']['field']['canonical']}}" class="form-control" name="canonical" value="{{ old('slug',($permission->canonical) ?? '') }}" />
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">{{$heading['create']['field']['description']}}</label>
                                    <textarea placeholder="{{$heading['create']['field']['description']}}" class="form-control" name="description" rows="1">{{ old('description',($permission->description) ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-white" name="cancel">{{$heading['create']['button']['cancel']}}</a>
                            <button class="btn btn-primary" type="submit" name="send" value="send">{{$heading['create']['button']['save']}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>