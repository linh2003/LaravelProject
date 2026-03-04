@include(
    'main.components.breadcrumb',
    [
        'breadcrumb_before' => 'Module manage',
        'breadcrumb_after'  => 'Module list'
    ]
)
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left mt-2">Module manage</h4>
                    <div class="float-right d-flex">
                        <a href="{{route('module.create')}}" class="btn btn-primary float-right">
                            <i class="feather icon-plus"></i>{{__('general.button.create')}}
                        </a>
                    </div>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        @include('main.module.component.table')
                        @include('main.module.component.modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>