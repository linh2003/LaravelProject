<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ $breadcrumb_after }}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/admin')}}">Home</a>
            </li>
            <li>
                <a>{{ $breadcrumb_before }}</a>
            </li>
            <li class="active">
                <strong>{{ $breadcrumb_after }}</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>