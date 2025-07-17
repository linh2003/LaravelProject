<div class="card">
    <div class="card-header">
        <h4 class="float-left mt-2">{{__('permission.view.tableheading')}}</h4>
		<div class="float-right d-flex">
			<a href="{{route('permission.create')}}" class="btn btn-primary float-right">
				<i class="feather icon-plus"></i>{{__('general.button.create')}}
			</a>
		</div>
    </div>
    <div class="card-block table-border-style">
        <div class="table-responsive">
            @include('main.users.permission.component.table')
        </div>
    </div>
</div>