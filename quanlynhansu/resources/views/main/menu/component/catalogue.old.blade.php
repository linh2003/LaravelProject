<div class="card">
	<div class="card-block accordion-block accordion-menu">
		<div id="single-open">
			<a class="accordion-msg waves-effect">{{__('menu.catalogue.manual.title')}}</a>
			<div class="accordion-desc">
			@php 
				$content = __('menu.catalogue.manual.content')
			@endphp
			@foreach($content as $k => $it)
				<p class="text-danger mb-3">+ {{$it}}</p>
			@endforeach
				<button type="button" class="btn btn-outline-info add-new-link-manual">{{__('menu.catalogue.manual.button')}}</button>
			</div>
			<a class="accordion-msg waves-effect">Module</a>
			<div class="accordion-desc">
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1501s. It was popularised in the 1961s with the release of Letraset.
				</p>
			</div>
			<a class="accordion-msg waves-effect">{{__('menu.catalogue.user.title')}}</a>
			<div class="accordion-desc">
			@php 
				$sub = __('menu.catalogue.user.sub')
			@endphp
			@foreach($sub as $k => $it)
				<div class="checkbox-zoom zoom-primary d-block">
					<label>
						<input type="checkbox" class="choose-menu" id="{{$it['url']}}" value="{{$it['label']}}">
						<span class="cr">
							<i class="cr-icon icofont icofont-ui-check txt-primary"></i>
						</span>
						<span>{{$it['label']}}</span>
					</label>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>