<div class="card">
    <div class="card-header">
        <h5>Thêm mới ngôn ngữ</h5>
    </div>
    <div class="card-block">
		@include('messages.message')
        <form action="{{route('admin.language.store')}}" method="post">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Language</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" placeholder="Enter Name Language">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Image</label>
						<div class="col-sm-10">
							<input type="text" class="form-control upload-image" name="image" data-type="Images">
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Canonical</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="canonical" placeholder="Enter Canonical Language">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Active</label>
						<div class="col-sm-10 col-form-label">
							<input type="checkbox" class="js-switch js-small" name="active" value="1">
						</div>
					</div>
				</div>
				<div class="form-group col-sm-12 text-right">
					<button type="submit" class="btn btn-primary m-b-0">
						<i class="feather icon-check"></i>
						<span>Save</span>
					</button>
				</div>
			</div>
        </form>
    </div>
</div>