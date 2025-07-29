@include(
    'main.components.breadcrumb',
    [
        'breadcrumb_before' => 'Permission'
    ]
)
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="card">
                <div class="card-header">
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
        </div>
    </div>
</div>