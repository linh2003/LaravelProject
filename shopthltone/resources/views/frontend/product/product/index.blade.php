@php   
	$albums = json_decode($product->album, true);
	$album = $albums;
	if(!is_array($album)){
		$album = explode(',',$albums);
		foreach($album as $k => $it){
			$album[$k] = json_decode($it, true);
		}
	}
@endphp
<div class="product-catalogue page-wrapper">
    @include('frontend.component.breadcrumb')
	<div class="popup-container">
		<div class="panel-body">
			<div class="uk-grid uk-grid-medium mb40">
				<div class="uk-width-large-1-2">
					<div class="popup-gallery">
						<div class="swiper-container product-swiper-large">
							<div class="swiper-wrapper big-pic">
								@foreach($album as $key => $img)
								<div class="swiper-slide">
									<img src="{{asset($img)}}" alt="">
								</div>
								@endforeach
							</div>
						</div>
						<div class="swiper-container-thumbs product-swiper-thumb">
							<div class="swiper-wrapper pic-list">
								@foreach($album as $key => $img)
								<div class="swiper-slide">
									<img src="{{asset($img)}}" alt="">
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="uk-width-large-1-2">
					<div class="popup-product">
						<h2 class="title"><span>{{$product->name}}</span></h2>
						<div class="rating">
							<div class="uk-flex uk-flex-middle">
								<div class="star">
									@for($i = 0; $i<=4; $i++)
									<i class="fa fa-star"></i>
									@endfor
								</div>
								<div class="rate-number">(65 reviews)</div>
							</div>
						</div>
						<div class="product-outstock">
						</div>
						<div class="price">
							<div class="uk-flex uk-flex-bottom">
								{!! displayPrice($product) !!}
							</div>
						</div>
						<div class="description">
						{!! $product->description !!}
						</div>
						<div class="attribute">
						@if(isset($product->attributes))
							@foreach($product->attributes as $attr)
							<div class="attribute-item">
								<div class="label">{{$attr->name}}: <span>{{$attr->attributes[0]->name}}</span></div>
								<div class="attribute-value">
								@foreach($attr->attributes as $k => $it)
									<a data-attribute-id="{{$it->id}}" data-product-id="{{$productId}}" class="choosen-attribute {{$k == 0 ? 'active' : ''}}" title="">{{$it->name}}</a>
								@endforeach
								</div>
							</div>
							@endforeach
						@endif
						</div><!-- .attribute -->
						<div class="quantity">
							<div class="text">Quantity</div>
							<div class="uk-flex uk-flex-middle">
								<div class="quantitybox uk-flex uk-flex-middle">
									<div class="minus quantity-button"><img src="{{asset('/frontend/resources/img/minus.svg')}}" alt=""></div>
									<input type="text" name="" value="1" class="quantity-text">
									<div class="plus quantity-button"><img src="{{asset('/frontend/resources/img/plus.svg')}}" alt=""></div>
								</div>
								<div class="btn-group uk-flex uk-flex-middle">
									<div class="btn-item btn-1"><a href="" title="">Add To Cart</a></div>
									<div class="btn-item btn-2"><a href="" title="">Buy Now</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-grid uk-grid-medium">
				<div class="uk-width-large-2-3">
					<div class="product-description">
						<div class="commit-item mb20"><h3>Thông tin sản phẩm</h3></div>
						{!! $product->content !!}
					</div>
				</div>
				<div class="uk-width-large-1-3">
				</div>
			</div>
		</div>
	</div>
</div>