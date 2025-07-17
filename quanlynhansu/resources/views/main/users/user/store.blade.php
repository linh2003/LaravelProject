<div class="card">
    <div class="card-header">
        <h5>Thêm mới ngôn ngữ</h5>
    </div>
    <div class="card-block">
		@include('messages.message')
		<form action="{{route('admin.language.store')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Họ tên</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="name" placeholder="Enter Name Language">
						</div>
					</div>
					
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Email</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="image" data-type="Images">
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Giới tính</label>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="image" data-type="Images">
						</div>
					</div>
				</div><!-- Row 1 -->
				<div class="col-sm-4">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Tỉnh (Thành phố)</label>
						<div class="col-sm-12">
							<select class="form-control" name="provinces">
								<option value="">-- Chọn --</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Quận (Huyện)</label>
						<div class="col-sm-12">
							<select class="form-control" name="districts">
								<option value="">-- Chọn --</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Phường (Xã)</label>
						<div class="col-sm-12">
							<select class="form-control" name="wards">
								<option value="">-- Chọn --</option>
							</select>
						</div>
					</div>
				</div><!-- Row 3 -->
			</div>
		</form>
    </div>
</div>