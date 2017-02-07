<?php $__env->startSection('main'); ?>
	<div class="col-md-10">
		<div class="product-overview shop">
			<div class="product-info">
				<div class="product-image-wrapper">
					<img class="fit-size" src="<?php echo $product->image_url; ?>" />
				</div>
				<div class="product-name">
					<h2><?php echo $product->brand; ?></h2>
					<div class="star-rating-wrapper">
						<span class="title">Overall Rating:&nbsp;&nbsp;</span>
						<div class="star-rating">
							<span style="width:<?php echo $product->overallrating*20; ?>%"></span>
						</div>
						<span class="marks"><?php echo $product->overallrating; ?></span>
					</div>
				</div>
			</div>
			<div class="product-overview-text">
				<h2>Product Overview</h2>
				<p><?php echo $product->description; ?></p>
			</div>
			<div class="compare-price-wrapper">
				<h2>Compare Prices:</h2>
			
				<table class="table mt-xl">
					<tbody>
						<?php if(!empty($price_comparison_list)): ?>
							<?php foreach($price_comparison_list as $item): ?>
							<tr>
								<th class="site-name">
									<a href="<?php echo $item->url; ?>"><?php echo $item->brand; ?></a>
								</th>
								<td class="shopping-type">
									<span><?php echo $item->shopping_type; ?></span>
								</td>
								<td class="price">
									<p class="price"><?php echo $item->price; ?><p>
									<?php if(!empty($item->tax_price)): ?>
										<p class="tax">+<?php echo $item->tax_price; ?> tax</p>
									<?php endif; ?>
									<?php if(!empty($item->dropped_percent)): ?>
										<p class="news"><i class="fa fa-arrow-circle-o-down"></i>&nbsp;Price dropped <?php echo $item->dropped_percent; ?></p>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php endif; ?>
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
				<?php if(!empty($review_list)): ?>
					<?php foreach($review_list as $item): ?>
					<div class="review">
						<div class="star-rating-wrapper">
							<div title="Rated 5 out of 5" class="star-rating">
								<span style="width:<?php echo $item->overallrating*20; ?>%"></span>
							</div>
							<span class="marks"><?php echo $item->overallrating; ?></span>
						</div>
						
						<h2><?php echo $item->title; ?></h2>
						<span class="date"><?php echo $item->date; ?></span>
						<p><?php echo $item->comment; ?></p>
						<span class="recommend"><i class="fa fa-check-circle"></i>&nbsp;<span>I would recommend this to a friend!</span></span>
					</div>
					<?php endforeach; ?>
				<?php endif; ?>
						
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
			<img src="<?php echo asset('img/advertisement/advertise-1.jpg'); ?>" />
		</a>
		<a class="pt-lg" href="#">
			<img src="<?php echo asset('img/advertisement/advertise-2.jpg'); ?>" />
		</a>
	</div>	

<?php $__env->stopSection(); ?>



<?php echo $__env->make('front.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>