@include(
	'backend.component.breadcrumb',
	[
		'breadcrumb_before' => $heading['index']['title'],
		'breadcrumb_after'  => $heading['delete']['title']
	]
)
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-4">
            <div class="panel-title"> {{ $heading['delete']['title'] }} </div>
			<div class="panel-description">
				<p>- Xóa thông tin nhóm người sử dụng</p>
				<p class="text-danger">- Lưu ý: Sau khi xóa sẽ không thể khôi phục lại. Bạn có chắc chắn muốn thực hiện tác vụ này!</p>
			</div>
        </div>
        <div class="col-lg-8">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="POST" action="{{ route('user.role.destroy',$role->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Tên nhóm thành viên&nbsp;</label>
                                    <input type="text" placeholder="Team member name" class="form-control" name="name" value="{{ old('name',($role->name) ?? '') }}" readonly />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Machine name&nbsp;</label>
                                    <input type="text" placeholder="Machine name" class="form-control" name="slug" value="{{ old('slug',($role->slug) ?? '') }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-white" name="cancel">Cancel</a>
                            <button class="btn btn-primary" type="submit" name="send" value="send">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>