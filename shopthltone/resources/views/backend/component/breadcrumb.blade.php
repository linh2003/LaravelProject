<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ isset($breadcrumb_after) ? $breadcrumb_after : $breadcrumb_before }}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/admin')}}">Home</a>
            </li>
			@if(isset($breadcrumb_after))
            <li>
                <a>{{ $breadcrumb_before }}</a>
            </li>
			@else
				<li class="active">
                <strong>{{ $breadcrumb_before }}</strong>
            </li>
			@endif
			@if(isset($breadcrumb_after))
            <li class="active">
                <strong>{{ $breadcrumb_after }}</strong>
            </li>
			@endif
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>