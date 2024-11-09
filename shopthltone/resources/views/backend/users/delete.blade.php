@include('backend.component.breadcrumb',['breadcrumb_before'=>$heading['index']['title'],'breadcrumb_after'=>$heading['delete']['title']])
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel-title">Xóa thành viên</div>
			<div class="panel-description">
				<p>- Xóa thông tin của người sử dụng</p>
				<p class="text-danger">- Lưu ý: Sau khi xóa sẽ không thể khôi phục lại. Bạn có chắc chắn muốn thực hiện tác vụ này!</p>
			</div>

        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('admin.user.destroy',$user->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Họ tên&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="text" placeholder="Fullname" class="form-control" name="fullname" value="{{ $user->fullname }}" readonly />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Email&nbsp;<span class="text-danger">(*)</span></label>
                                    <input type="email" placeholder="Email" class="form-control" name="email" value="{{ $user->email }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-white" name="cancel">Cancel</a>
                            <button class="btn btn-danger" type="submit" name="send" value="send">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>