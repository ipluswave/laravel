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
									<a href="{!! $item->url !!}">{!! $item->merchant !!}</a>
								</th>
								<td class="shopping-type">
									<span>{!! $item->shipType !!}</span>
								</td>
								<td class="price">
									<p class="price">{!! $item->price !!}<p>
									@if(!empty($item->tax_price))
										<p class="tax">+{!! $item->tax_price !!} tax</p>
									@endif
									@if(!empty($item->dropped_percent))
										<p class="news"><i class="fa fa-arrow-circle-o-down"></i>&nbsp;Price dropped {!! $item->dropped_percent !!}%</p>
									@endif
								</td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			
			<div class="top-reviews-wrapper">
				@if(!empty($review_list))
				<h2>Top Reviews:</h2>
					@foreach($review_list as $item)
					<div class="review">
						<div class="star-rating-wrapper">
							<div title="Rated 5 out of 5" class="star-rating">
								<span style="width:{!! $item->rating*20 !!}%"></span>
							</div>
							<span class="marks">{!! $item->rating !!}</span>
						</div>
						
						<h2>{!! $item->title !!}</h2>
						<?php
						$date = new DateTime($item->submissionTime);
						$date_string = $date->format('M d, Y');
						?>
						<span class="date">{!! $date_string !!}</span>
						<p>{!! $item->comment !!}</p>
						@if(!empty($item->rating >= 3.5))
							<span class="recommend"><i class="fa fa-check-circle"></i>&nbsp;<span>I would recommend this to a friend!</span></span>
						@endif
					</div>
					@endforeach
				@else
					<h2>No Review</h2>
				@endif
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


