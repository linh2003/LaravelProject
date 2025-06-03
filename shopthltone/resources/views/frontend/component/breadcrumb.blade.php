
<div class="page-breadcrumb background">      
    <div class="uk-container uk-container-center">
        <ul class="uk-list uk-clearfix">
            <li><a href="{{asset('/')}}"><i class="fi-rs-home mr5"></i></a></li>
            @if(!is_null($breadcrumb))
                @foreach($breadcrumb as $key => $val)
                @php
                    $name = $val->languages->first()->pivot->name;
                    $canonical = writeUrl($val->languages->first()->pivot->canonical, true, true);
                @endphp
                @if($key < count($breadcrumb) - 1)
					<li><a href="{{ $canonical }}" title="{{ $name }}">{{ $name }}</a></li>
				@else
					<li><span>{{ $name }}</span></li>
				@endif
                @endforeach
            @endif
        </ul>
    </div>
</div>