@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['role']['change'],'breadcrumb_after'=>$heading['role']['change']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel-title">Cập nhật nhóm của thành viên</div>
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
                    <form method="POST" action="{{route('admin.user.applyrole')}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn nhóm thành viên&nbsp;<span class="text-danger">(*)</span></label>
                                    <select class="form-control setupSelect2" name="changerole">
										<option value="">-- Select --</option>
										@foreach($roles as $r)
										<option value="{{$r->id}}">{{$r->name}}</option>
										@endforeach
									</select>
                                </div>
                            </div>
							<div class="col-sm-8">
								@php $arrId = implode(',',$userids); @endphp
								<input type="hidden" value="{{$arrId}}" name="uids" />
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-white" name="cancel">Cancel</a>
                            <button class="btn btn-primary" type="submit" name="send" value="send">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>