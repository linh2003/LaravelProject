<div class="panel-slide page-setup mb40">
	<div class="uk-container uk-container-center">
		<div class="slick-single-large">
		@for($i = 0; $i < 4; $i++)
			@php $src = 'frontend/images/banner-home-'.($i+1).'.png';  @endphp
			<div class="slide-item">
				<img src="{{asset($src)}}" alt="">
			</div>
		@endfor
		</div>
	</div>
</div>