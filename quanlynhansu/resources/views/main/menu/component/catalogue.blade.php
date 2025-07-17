<div class="card">
	<div class="card-block accordion-block accordion-menu">
		<div id="single-open">
			<a class="accordion-msg">{{__('menu.catalogue.manual.title')}}</a>
			<div class="accordion-desc">
			@php 
				$content = __('menu.catalogue.manual.content')
			@endphp
			@foreach($content as $k => $it)
				<p class="text-danger mb-3">+ {{$it}}</p>
			@endforeach
				<button type="button" class="btn btn-outline-info add-new-link-manual">{{__('menu.catalogue.manual.button')}}</button>
			</div>
			<a class="accordion-msg">{{__('menu.catalogue.available.title')}}</a>
			<div class="accordion-desc">
			@foreach($routers as $key => $route)
			@php
				if(!isset($route->action['controller']) || count($route->methods) <= 1) {
					continue;
				}
				$name = $route->action['as'] ?? 'No name';
			@endphp
				<div class="checkbox-zoom zoom-primary d-block">
					<label>
					@php $id = convertUnicode($name) @endphp
						<input type="checkbox" class="choose-menu" id="{{$id}}" value="{{$name}}">
						<span class="cr">
							<i class="cr-icon icofont icofont-ui-check txt-primary"></i>
						</span>
						<span>{{$name}}</span>
					</label>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>