@extends('front.template')

@section('main')

	<div class="home-search" id="home-search">
		<div class="wrapper">
			<div class="header-search">
				<form id="searchForm" action="{!! url('index').'/'.$category !!}" method="get">
					<div class="input-group">
						<input type="text" class="form-control" name="q" id="q" value="{!! $keyword !!}" placeholder="What Product Are You Looking For" required>
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<section class="a2z-notice">
		<div class="wrapper">
			<div class="col-md-12">
				<div class="notice-text">
					<p>A2Z Reviews aggregates product reviews from the top sources to provide a one stop source for shoppers. Our site has been designed to show you the ratings, reviews and compare prices so you find the best deal!</p>
				</div>
			</div>
			<div class="col-md-12">
				<div class="notice-user-text">
					<p>“I love A2Z Reviews - so easy to use plus you don’t need to be a member to access the information.”</p>
				</div>
			</div>
		</div>
	</section>

	<div class="">
		<div class="categories-container">
			<h2 class="title mt-lg">CATEGORIES</h2>

			<div class="row">
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Computers & Tablets') !!}">
						<img class="icon-category" src="{!! asset('img/categories/computers_tablets.png') !!}" />
						<h2 class="header-category">Computers & Tablets</h2>
					</a>	
				</div>
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Electronics') !!}">
						<img class="icon-category" src="{!! asset('img/categories/electronics.png') !!}" />
						<h2 class="header-category">Electronics</h2>
					</a>	
				</div>
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Home & Garden') !!}">
						<img class="icon-category" src="{!! asset('img/categories/home_garden.png') !!}" />
						<h2 class="header-category">Home & Garden</h2>
					</a>	
				</div>
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Automobile') !!}">
						<img class="icon-category" src="{!! asset('img/categories/automobile.png') !!}" />
						<h2 class="header-category">Automobile</h2>
					</a>	
				</div>
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Baby') !!}">
						<img class="icon-category" src="{!! asset('img/categories/baby.png') !!}" />
						<h2 class="header-category">Baby</h2>
					</a>	
				</div>
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Kids') !!}">
						<img class="icon-category" src="{!! asset('img/categories/kids.png') !!}" />
						<h2 class="header-category">Kids</h2>
					</a>	
				</div>
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Sports & Outdoors') !!}">
						<img class="icon-category" src="{!! asset('img/categories/sports_outdoors.png') !!}" />
						<h2 class="header-category">Sports & Outdoors</h2>
					</a>	
				</div>
				<div class="category-item col-lg-3 col-md-4 col-xs-6">
					<a href="{!! url('index/Clothing & Accessories') !!}">
						<img class="icon-category" src="{!! asset('img/categories/clothing_accessories.png') !!}" />
						<h2 class="header-category">Clothing & Accessories</h2>
					</a>	
				</div>
			</div>
		</div>
	</div>				

@stop


