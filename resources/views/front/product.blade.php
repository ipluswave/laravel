@extends('front.template')

@section('main')
	<div class="col-md-10">
		<div class="product-overview shop">
			<div class="product-info">
				<div class="product-image-wrapper">
					<img class="fit-size" src="{!! $product->image_url !!}" />
				</div>
				<div class="product-name">
					<h2>{!! $product->brand !!}</h2>
					<div class="star-rating-wrapper">
						<span class="title">Overall Rating:&nbsp;&nbsp;</span>
						<div class="star-rating">
							<span style="width:{!! $product->overallrating*20 !!}%"></span>
						</div>
						<span class="marks">{!! $product->overallrating !!}</span>
					</div>
				</div>
			</div>
			<div class="product-overview-text">
				<h2>Product Overview</h2>
				<p>{!! $product->description !!}</p>
			</div>
			<div class="compare-price-wrapper">
				<h2>Compare Prices:</h2>
			
				<table class="table mt-xl">
					<tbody>
						@if(!empty($price_comparison_list))
							@foreach($price_comparison_list as $item)
							<tr>
								<th class="site-name">
									<a href="{!! $item->url !!}">{!! $item->brand !!}</a>
								</th>
								<td class="shopping-type">
									<span>{!! $item->shopping_type !!}</span>
								</td>
								<td class="price">
									<p class="price">{!! $item->price !!}<p>
									@if(!empty($item->tax_price))
										<p class="tax">+{!! $item->tax_price !!} tax</p>
									@endif
									@if(!empty($item->dropped_percent))
										<p class="news"><i class="fa fa-arrow-circle-o-down"></i>&nbsp;Price dropped {!! $item->dropped_percent !!}</p>
									@endif
								</td>
							</tr>
							@endforeach
						@endif
						<tr>
							<th class="site-name">
								<a href="https://jet.com/">Jet.com</a>
							</th>
							<td class="shopping-type">
								<span>Free shipping</span>
							</td>
							<td class="price">
								<p class="price">$99.99<p>
								<p class="tax">+$8.00 tax</p>
							</td>
						</tr>
						<tr>
							<th class="site-name">
								<a href="http://www.newegg.com/">Newegg.com</a>
							</th>
							<td class="shopping-type">
								<span>Free shipping, No tax</span>
							</td>
							<td class="price">
								<p class="price">$99.99<p>
							</td>
						</tr>
						<tr>
							<th class="site-name">
								<a href="#">B&H Photo-Video-Audio</a>
							</th>
							<td class="shopping-type">
								<span>Free shipping</span>
							</td>
							<td class="price">
								<p class="price">$99.95<p>
								<p class="tax">+$8.00 tax</p>
							</td>
						</tr>
						<tr>
							<th class="site-name">
								<a href="http://intl.target.com/">Target</a>
							</th>
							<td class="shopping-type">
								<span>Free shipping</span>
							</td>
							<td class="price">
								<p class="price">$99.99<p>
								<p class="tax">+$8.00 tax</p>
								<p class="news"><i class="fa fa-arrow-circle-o-down"></i>&nbsp;Price dropped 20%</p>
							</td>
						</tr>
						<tr>
							<th class="site-name">
								<a href="http://www.officedepot.com/">Office Depot</a>
							</th>
							<td class="shopping-type">
								<span>Free shipping</span>
							</td>
							<td class="price">
								<p class="price">$99.99<p>
								<p class="tax">+$8.00 tax</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div class="top-reviews-wrapper">
				<h2>Top Reviews:</h2>
				@if(!empty($review_list))
					@foreach($review_list as $item)
					<div class="review">
						<div class="star-rating-wrapper">
							<div title="Rated 5 out of 5" class="star-rating">
								<span style="width:{!! $item->overallrating*20 !!}%"></span>
							</div>
							<span class="marks">{!! $item->overallrating !!}</span>
						</div>
						
						<h2>{!! $item->title !!}</h2>
						<span class="date">{!! $item->date !!}</span>
						<p>{!! $item->comment !!}</p>
						<span class="recommend"><i class="fa fa-check-circle"></i>&nbsp;<span>I would recommend this to a friend!</span></span>
					</div>
					@endforeach
				@endif
						
				<div class="review">
					<div class="star-rating-wrapper">
						<div title="Rated 4.6 out of 5" class="star-rating">
							<span style="width:92%"><strong class="rating">4.6</strong> out of 5</span>
						</div>
						<span class="marks">4.6</span>
					</div>
					
					<h2>Great. Haven't noticed a difference</h2>
					<span class="date">March 13, 2016</span>
					<p>Bought Ooma as part of the cable-cord-cutting process and am loving it. Haven't noticed a difference and am saving $15 / month ($20 for charter phone down to $4.24 in taxes for Ooma. My wife wanted to keep the home number, so we ported that ( $40 and maybe a week or two of time), which worked fine. And some nice bonus features (voicemail messages to Dropbox, etc).</p>
					<span class="recommend"><i class="fa fa-check-circle"></i>&nbsp;I would recommend this to a friend!</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2 advertisement">
		<a class="pb-lg" href="#">
			<img src="{!! asset('img/advertisement/advertise-1.jpg') !!}" />
		</a>
		<a class="pt-lg" href="#">
			<img src="{!! asset('img/advertisement/advertise-2.jpg') !!}" />
		</a>
	</div>	

@stop


