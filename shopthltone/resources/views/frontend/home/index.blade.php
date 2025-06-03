
@include('frontend.home.slide')
<div class="panel-product-catalogue mb40">
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-medium">
		@if(isset($catData['catChild']) && count($catData['catChild']))
		@foreach($catData['catChild'] as $k => $cat)
			<div class="uk-width-large-1-6">
				<div class="category-item mb-10">
				@php
                    $canonical = writeUrl($cat['canonical'], true, true);
                @endphp
					<a href="{{$canonical}}" class="image img-scaledown img-zoomin">
						<img src="{{asset($cat['image'])}}" />
					</a>
					@if(isset($cat['promotion']) && $cat['promotion'] > 0) <div class="discount-cat-main"><span class="sale">-{{$cat['promotion']}}%</span></div> @endif
					<div class="title"><a href="{{$canonical}}" title="">{{$cat['name']}}</a></div>
				</div>
			</div>
		@endforeach
		@endif
		</div>
	</div>
</div>
<div class="panel-banner mb40">
	<div class="uk-container uk-container-center">
		<div class="panel-body">
		<div class="slick-double-item">
		@for($i = 0; $i < 4; )
			<div class="ibox-content banner-item">
				<span class="image"><img src="{{asset('/frontend/images/panel-home-'.(++$i).'.png')}}" alt=""></span>
			</div>
			<div class="ibox-content banner-item">
				<span class="image"><img src="{{asset('/frontend/images/panel-home-'.(++$i).'.png')}}" alt=""></span>
			</div>
		@endfor
		</div>
		</div>
	</div>
</div>
<!-- Sản phẩm giảm giá -->

@if(isset($sale) && count($sale))
<div class="panel-product panel-product-sale mb40">
	<div class="uk-container uk-container-center">
		<div class="panel-head">
			<div class="uk-flex uk-flex-middle uk-flex-space-between">
				<h2 class="heading-1"><span>Sản phẩm giảm giá</span></h2>
			</div>
		</div>
		<div class="panel-body">
			<div class="uk-grid uk-grid-medium">
				<div class="uk-width-large-1-4">
					<div class="best-seller-banner">
						<a href="" class="image img-cover"><img src="{{asset('frontend/images/banner-sale-home.png')}}" alt=""></a>
					</div>
				</div>
				<div class="uk-width-large-3-4">
					<div class="product-wrapper slick-multiple-item">
					@foreach($sale as $k => $item)
						@if($item->price > 0)
						<div class="ibox-content">
							@include('frontend.component.product_item')
						</div>
						@endif
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<!-- Sản phẩm đề xuất -->
@if(isset($popular) && count($popular))
<div class="panel-product panel-product-suggest mb40">
	<div class="uk-container uk-container-center">
		<div class="panel-head">
			<div class="uk-flex uk-flex-middle uk-flex-space-between">
				<h2 class="heading-1"><span>Đề xuất cho bạn</span></h2>
			</div>
		</div>
		<div class="panel-body">
			<div class="uk-grid uk-grid-medium">
				@foreach($popular as $k => $item)
					@if($item->price > 0)
					<div class="uk-width-large-1-5 mb20">
						@include('frontend.component.product_item')
					</div>
					@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
<div class="panel-commit">
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-medium">
			<div class="uk-width-large-1-5">
				<div class="commit-item">
					<div class="uk-flex uk-flex-middle">
						<span class="image"><img src="{{asset('frontend/resources/img/commit-1.png')}}" alt=""></span>
						<div class="info">
							<div class="title">Giá ưu đãi</div>
							<div class="description">Khi mua từ 500.000đ</div>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-width-large-1-5">
				<div class="commit-item">
					<div class="uk-flex uk-flex-middle">
						<span class="image"><img src="{{asset('frontend/resources/img/commit-2.png')}}" alt=""></span>
						<div class="info">
							<div class="title">Miễn phí vận chuyển</div>
							<div class="description">Trong bán kính 2km</div>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-width-large-1-5">
				<div class="commit-item">
					<div class="uk-flex uk-flex-middle">
						<span class="image"><img src="{{asset('frontend/resources/img/commit-3.png')}}" alt=""></span>
						<div class="info">
							<div class="title">Ưu đãi</div>
							<div class="description">Khi đăng ký tài khoản</div>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-width-large-1-5">
				<div class="commit-item">
					<div class="uk-flex uk-flex-middle">
						<span class="image"><img src="{{asset('frontend/resources/img/commit-4.png')}}" alt=""></span>
						<div class="info">
							<div class="title">Đa dạng </div>
							<div class="description">Sản phẩm đa dạng</div>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-width-large-1-5">
				<div class="commit-item">
					<div class="uk-flex uk-flex-middle">
						<span class="image"><img src="{{asset('frontend/resources/img/commit-5.png')}}" alt=""></span>
						<div class="info">
							<div class="title">Đổi trả </div>
							<div class="description">Đổi trả trong ngày</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
@endif
