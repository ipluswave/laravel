<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>{{ trans('front/site.title') }}</title>
		<meta name="keywords" content="A2Z Reviews - Homepage" />
		<meta name="description" content="A2Z Reviews - Homepage">
		<meta name="author" content="sanchez.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{!! asset('img/favicon.ico') !!}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{!! asset('img/apple-touch-icon.png') !!}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		
		@yield('head')

		<!-- Web Fonts  -->
		{!! HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light') !!}
		{!! HTML::style('https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,300italic,300,100italic,100,700,700italic,500italic') !!}
		<!-- Vendor CSS -->
		{!! HTML::style('vendor/bootstrap/css/bootstrap.min.css') !!}
		{!! HTML::style('vendor/font-awesome/css/font-awesome.min.css') !!}
		{!! HTML::style('vendor/simple-line-icons/css/simple-line-icons.min.css') !!}
		{!! HTML::style('vendor/owl.carousel/assets/owl.carousel.min.css') !!}
		{!! HTML::style('vendor/owl.carousel/assets/owl.theme.default.min.css') !!}
		{!! HTML::style('vendor/magnific-popup/magnific-popup.min.css') !!}
		<!-- Theme CSS -->
		{!! HTML::style('css/theme.css') !!}
		{!! HTML::style('css/theme-elements.css') !!}
		{!! HTML::style('css/theme-blog.css') !!}
		{!! HTML::style('css/theme-shop.css') !!}
		{!! HTML::style('css/theme-animate.css') !!}
		<!-- Skin CSS -->
		{!! HTML::style('css/skins/default.css') !!}
		
		<!-- Theme Custom CSS -->
		{!! HTML::style('css/custom.css') !!}
		
		<!-- Head Libs -->
		{!! HTML::script('vendor/modernizr/modernizr.min.js') !!}

	</head>

  <body>

		<div class="body">
			<header id="header" data-plugin-options='{"stickyEnabled": false, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
				<div class="header-body">
					<div class="header-row header-brand">
						<div class="header-column">
							<div class="header-logo">
								<a href="{!! url('index') !!}">
									<img alt="A2Z Reviews" width="300" height="250" data-sticky-width="200" data-sticky-height="160" data-sticky-top="33" src="{!! asset('img/logo.png') !!}">
								</a>
							</div>
						</div>
						<div class="header-column pull-right">
							<div class="header-row">
								<ul class="header-social-icons social-icons hidden-xs">
									<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
									<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
									<li class="social-icons-digg"><a href="http://digg.com/" target="_blank" title="Digg"><i class="fa fa-digg"></i></a></li>
									<li class="social-icons-google"><a href="http://www.google.com/" target="_blank" title="Linkedin"><i class="fa fa-google"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="header-row">
						<div class="header-nav header-nav-center">
							<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
								<i class="fa fa-bars"></i>
							</button>
							<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
								<nav>
									<ul class="nav nav-pills" id="mainNav">
										<li class="dropdown">
											<a class="dropdown-toggle" href="{!! url('index/computer | Tablet') !!}">
												Computer & Tablets
											</a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu">
													<a href="{!! url('index/tablet') !!}">Tablets</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/tablet') !!}">All Tablets</a></li>
														<li><a href="{!! url('index/tablet & 2-in-ls') !!}">2-in-ls</a></li>
														<li><a href="{!! url('index/Kid & Tablets') !!}">Kids' Tablets</a></li>
														<li><a href="{!! url('index/iPad | Tablet Accessories') !!}">iPad & Tablet Accessories</a></li>
														<li><a href="{!! url('index/IPad') !!}">IPad</a></li>
														<li><a href="{!! url('index/E-Reader') !!}">E-Readers</a></li>
														<li><a href="{!! url('index/Refurbished & Tablet') !!}">Refurbished Tablets</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Laptop') !!}">Laptops</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/PC | Laptop') !!}">PC Laptops</a></li>
														<li><a href="{!! url('index/MacBook') !!}">MacBooks</a></li>
														<li><a href="{!! url('index/Chromebook') !!}">Chromebooks</a></li>
														<li><a href="{!! url('index/Laptop & Package') !!}">Laptop Packages</a></li>
														<li><a href="{!! url('index/Laptop & 2-in-1s') !!}">2-in-1s</a></li>
														<li><a href="{!! url('index/Gaming & Laptop') !!}l">Gaming Laptops</a></li>
														<li><a href="{!! url('index/Refurbished & Laptop') !!}">Refurbished Laptops</a></li>
														<li><a href="{!! url('index/Laptop & Accessories') !!}">Laptop Accessories</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/2 in 1s') !!}">2 in 1s</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/2 in 1s & HP') !!}">HP</a></li>
														<li><a href="{!! url('index/2 in 1s & Microsoft Surface') !!}">Microsoft Surface</a></li>
														<li><a href="{!! url('index/2 in 1s & Lenovo') !!}">Lenovo</a></li>
														<li><a href="{!! url('index/2 in 1s & Dell') !!}">Dell</a></li>
														<li><a href="{!! url('index/2 in 1s & Asus') !!}">Asus</a></li>
														<li><a href="{!! url('index/2 in 1s & Toshiba') !!}">Toshiba</a></li>
														<li><a href="{!! url('index/2 in 1s & Accessories') !!}">2-in-1 Accessories</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Desktop | All-in-Ones') !!}">Desktop and All-in-Ones</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Desktop') !!}">All Desktops</a></li>
														<li><a href="{!! url('index/Tower Only') !!}">Towers Only</a></li>
														<li><a href="{!! url('index/Desktop & Package') !!}">Desktop Packages</a></li>
														<li><a href="{!! url('index/All-in-One & Computer') !!}">All-in-One Computers</a></li>
														<li><a href="{!! url('index/Apple iMacs, mini | Mac Pros') !!}">Apple iMacs, minis & Mac Pros</a></li>
														<li><a href="{!! url('index/Gaming & Desktop') !!}">Gaming Desktops</a></li>
														<li><a href="{!! url('index/Refurbished & Desktop') !!}">Refurbished Desktops</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/PC & Gaming') !!}">PC Gaming</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Gaming & Desktop') !!}">Gaming Desktops</a></li>
														<li><a href="{!! url('index/Gaming & Monitor') !!}">Gaming Monitors</a></li>
														<li><a href="{!! url('index/Gaming & Laptop') !!}">Gaming Laptops</a></li>
														<li><a href="{!! url('index/PC & Gaming & Peripheral') !!}">PC Gaming Peripherals</a></li>
														<li><a href="{!! url('index/Computer Card & Component') !!}">Computer Cards & Components</a></li>
														<li><a href="{!! url('index/PC & Game') !!}">PC Games</a></li>
														<li><a href="{!! url('index/PC & Game & Download') !!}">PC Game Downloads</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Monitor') !!}">Monitors</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Monitor') !!}">All Monitors</a></li>
														<li><a href="{!! url('index/LCD Monitor') !!}">LCD Monitors</a></li>
														<li><a href="{!! url('index/LED Monitor') !!}">LED Monitors</a></li>
														<li><a href="{!! url('index/IPS Monitor') !!}">IPS Monitors</a></li>
														<li><a href="{!! url('index/Gaming Monitor') !!}">Gaming Monitors</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Network | Wireless') !!}">Network & Wireless</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Router') !!}">Routers</a></li>
														<li><a href="{!! url('index/DSL | Cable Modem | Gateway') !!}">DSL & Cable Modems and Gateways</a></li>
														<li><a href="{!! url('index/Network Card') !!}">Network Cards</a></li>
														<li><a href="{!! url('index/PC USB Wireless Adapter') !!}">PC USB Wireless Adapters</a></li>
														<li><a href="{!! url('index/PC Range Extender') !!}">PC Range Extenders</a></li>
														<li><a href="{!! url('index/Ethernet Hub | Switch') !!}">Ethernet Hubs & Switches</a></li>
														<li><a href="{!! url('index/Streaming Media Player') !!}">Streaming Media Players</a></li>
														<li><a href="{!! url('index/VoIP') !!}">VoIP</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Hard Drives | Storage') !!}">Hard Drives and Storage</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Hard Drive') !!}">All Hard Drives</a></li>
														<li><a href="{!! url('index/External Hard Drive') !!}">External Hard Drives</a></li>
														<li><a href="{!! url('index/Internal Hard Drive') !!}">Internal Hard Drives</a></li>
														<li><a href="{!! url('index/Mac External Hard Drive') !!}">Mac External Hard Drives</a></li>
														<li><a href="{!! url('index/Solid State Drive') !!}">Solid State Drives</a></li>
														<li><a href="{!! url('index/NAS/Personal Cloud Storage') !!}">NAS/Personal Cloud Storage</a></li>
														<li><a href="{!! url('index/USB Flash Drive') !!}">USB Flash Drives</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Printer') !!}">Printers</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Printer') !!}">All Printers</a></li>
														<li><a href="{!! url('index/3D Printers | Filament') !!}">3D Printers & Filament</a></li>
														<li><a href="{!! url('index/All-In-One Printer') !!}">All-In-One Printers</a></li>
														<li><a href="{!! url('index/Inkjet Printer') !!}">Inkjet Printers</a></li>
														<li><a href="{!! url('index/Laser Printer') !!}">Laser Printers</a></li>
														<li><a href="{!! url('index/Photo Printer') !!}">Photo Printers</a></li>
														<li><a href="{!! url('index/Portable Printer') !!}">Portable Printers</a></li>
														<li><a href="{!! url('index/Ink | Toner') !!}">Ink & Toner</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-toggle" href="{!! url('index/Electronic') !!}">
												Electronics
											</a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu">
													<a href="{!! url('index/DSLR Camera') !!}">DSLR Cameras</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/DSLR Camera') !!}">All DSLR Cameras</a></li>
														<li><a href="{!! url('index/DSLR Body | Len') !!}">DSLR Body & Lens</a></li>
														<li><a href="{!! url('index/DSLR Body Only') !!}">DSLR Body Only</a></li>
														<li><a href="{!! url('index/DSLR Package Deal') !!}">DSLR Package Deals</a></li>
														<li><a href="{!! url('index/Wi-Fi DSLR') !!}">Wi-Fi DSLRs</a></li>
														<li><a href="{!! url('index/Full-Frame DSLR') !!}">Full-Frame DSLRs</a></li>
														<li><a href="{!! url('index/Full-Frame DSLR') !!}">Full-Frame DSLRs</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Point | Shoot Cameras') !!}">Point & Shoot Cameras</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Point | Shoot Cameras') !!}">All Point & Shoot Cameras</a></li>
														<li><a href="{!! url('index/Waterproof Point | Shoot') !!}">Waterproof Point & Shoot</a></li>
														<li><a href="{!! url('index/Wi-Fi Point  Shoot') !!}">Wi-Fi Point & Shoot</a></li>
														<li><a href="{!! url('index/Long Zoom Point | Shoot') !!}">Long Zoom Point & Shoot</a></li>
														<li><a href="{!! url('index/Premium Point | Shoot') !!}">Premium Point & Shoot</a></li>
														<li><a href="{!! url('index/Instant Print Point | Shoot') !!}">Instant Print Point & Shoot</a></li>
														<li><a href="{!! url('index/Digital Camera Accessories') !!}">Digital Camera Accessories</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Camcorder') !!}">Camcorders</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/4K Camcorder') !!}">4K Camcorders</a></li>
														<li><a href="{!! url('index/Wi-Fi Camcorder') !!}">Wi-Fi Camcorders</a></li>
														<li><a href="{!! url('index/Camcorder Accessories') !!}">Camcorder Accessories</a></li>
														<li><a href="{!! url('index/Action Camcorder') !!}">All Action Camcorders</a></li>
														<li><a href="{!! url('index/Action Camcorder Accessories') !!}">Action Camcorder Accessories</a></li>
														<li><a href="{!! url('index/360 Degree Camera') !!}">360 Degree Cameras</a></li>
														<li><a href="{!! url('index/Aerial Drones with Camera') !!}">Aerial Drones with Camera</a></li>
														<li><a href="{!! url('index/Aerial Drone Accessories') !!}">Aerial Drone Accessories</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Video Game') !!}">Video Games</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Xbox One') !!}">Xbox One</a></li>
														<li><a href="{!! url('index/Xbox 360') !!}">Xbox 360</a></li>
														<li><a href="{!! url('index/PlayStation 4') !!}">PlayStation 4</a></li>
														<li><a href="{!! url('index/PlayStation 3') !!}">PlayStation 3</a></li>
														<li><a href="{!! url('index/Wii U') !!}">Wii U</a></li>
														<li><a href="{!! url('index/Nintendo 3D') !!}">Nintendo 3DS</a></li>
														<li><a href="{!! url('index/PC Gaming') !!}">PC Gaming</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Wearable Technology') !!}">Wearable Technology</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Activity Tracker | Pedometer') !!}">Activity Trackers & Pedometers</a></li>
														<li><a href="{!! url('index/Apple Watch') !!}">Apple Watch</a></li>
														<li><a href="{!! url('index/Fitness | GPS Watch') !!}">Fitness & GPS Watches</a></li>
														<li><a href="{!! url('index/Headphone') !!}">Headphones</a></li>
														<li><a href="{!! url('index/Smart Sports Equipment') !!}">Smart Sports Equipment</a></li>
														<li><a href="{!! url('index/Smart Tracker Tag') !!}">Smart Tracker Tags</a></li>
														<li><a href="{!! url('index/Smartwatches | Accessories') !!}">Smartwatches & Accessories</a></li>
														<li><a href="{!! url('index/Virtual Reality Headset') !!}">Virtual Reality Headsets</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Car Electronic | GPS') !!}">Car Electronics & GPS</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/GPS Navigation | Accessories') !!}">GPS Navigation & Accessories</a></li>
														<li><a href="{!! url('index/Car Audio') !!}">Car Audio</a></li>
														<li><a href="{!! url('index/Car Security | Remote Starters') !!}">Car Security & Remote Starters</a></li>
														<li><a href="{!! url('index/Car Video') !!}">Car Video</a></li>
														<li><a href="{!! url('index/Car Safety | Convenience') !!}">Car Safety & Convenience</a></li>
														<li><a href="{!! url('index/Car Lights | Lighting Accessories') !!}">Car Lights & Lighting Accessories</a></li>
														<li><a href="{!! url('index/Smartphone | iPod Car Connector') !!}">Smartphone & iPod Car Connectors</a></li>
														<li><a href="{!! url('index/Satellite Radio') !!}">Satellite Radios</a></li>
														<li><a href="{!! url('index/Radar Detector') !!}">Radar Detectors</a></li>
														<li><a href="{!! url('index/Car Installation Part | Accessories') !!}">Car Installation Parts & Accessories</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Television') !!}">Televisions</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/4K Ultra HD TV') !!}">4K Ultra HD TVs</a></li>
														<li><a href="{!! url('index/Smart TV') !!}">Smart TVs</a></li>
														<li><a href="{!! url('index/Curved TV') !!}">Curved TVs</a></li>
														<li><a href="{!! url('index/LED TV') !!}">LED TVs</a></li>
														<li><a href="{!! url('index/OLED TV') !!}">OLED TVs</a></li>
														<li><a href="{!! url('index/Outdoor TV') !!}">Outdoor TVs</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/>A/V Component') !!}">A/V Components</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Blu-ray | DVD Player') !!}">Blu-ray & DVD Players</a></li>
														<li><a href="{!! url('index/Home Audio') !!}">Home Audio</a></li>
														<li><a href="{!! url('index/Receiver | Speaker | Wireless Audio | A/V Component') !!}">Receivers, Speakers, Wireless Audio & More</a></li>
														<li><a href="{!! url('index/Home Theater System') !!}">Home Theater Systems</a></li>
														<li><a href="{!! url('index/Projector') !!}">Projectors & Screens</a></li>
														<li><a href="{!! url('index/Sound Bar') !!}">Sound Bars</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/tablets') !!}">Portable Audio</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/tablets') !!}">iPod & MP3 Players</a></li>
														<li><a href="{!! url('index/tablets') !!}">Headphones</a></li>
														<li><a href="{!! url('index/tablets') !!}">Docks, Radios & Boomboxes</a></li>
														<li><a href="{!! url('index/tablets') !!}">Bluetooth & Wireless Speakerss</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Home Audio') !!}">Home Audio</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Home Theater System') !!}">Home Theater Systems</a></li>
														<li><a href="{!! url('index/Receiver | Amplifier') !!}">Receivers & Amplifiers</a></li>
														<li><a href="{!! url('index/Speaker') !!}">Speakers</a></li>
														<li><a href="{!! url('index/CD Player & Turntable') !!}">CD Players & Turntables</a></li>
														<li><a href="{!! url('index/Stereo Shelf System') !!}">Stereo Shelf Systems</a></li>
														<li><a href="{!! url('index/Wireless | Multiroom Audio') !!}">Wireless & Multiroom Audio</a></li>
														<li><a href="{!! url('index/Home Audio Accessories') !!}">Home Audio Accessories</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-toggle" href="{!! url('index/Home | Garden') !!}">
												Home & Garden
											</a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu">
													<a href="{!! url('index/Kitchen Appliance') !!}">Kitchen Appliances</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Small Kitchen Appliances') !!}">Small Kitchen Appliances</a></li>
														<li><a href="{!! url('index/Coffee | Blender | Mixer | Cookware') !!}">Coffee, Blenders, Mixers, Cookware & More</a></li>
														<li><a href="{!! url('index/Refrigerator') !!}">Refrigerators</a></li>
														<li><a href="{!! url('index/Freezer | Ice Maker') !!}">Freezers & Ice Makers</a></li>
														<li><a href="{!! url('index/Wine Refrigerator') !!}">Wine Refrigerators & Coolers</a></li>
														<li><a href="{!! url('index/Dishwasher') !!}">Dishwashers</a></li>
														<li><a href="{!! url('index/Range | Cooktop | Wall Oven') !!}">Ranges, Cooktops & Wall Ovens</a></li>
														<li><a href="{!! url('index/Range Hood') !!}">Range Hoods</a></li>
														<li><a href="{!! url('index/Microwave') !!}">Microwaves</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Laundry & Garment Care') !!}">Laundry & Garment Care</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Washer & Dryer') !!}">Washers & Dryers</a></li>
														<li><a href="{!! url('index/Laundry Package') !!}">Laundry Packages</a></li>
														<li><a href="{!! url('index/Iron | Steamer | Sewing Machine') !!}">Irons, Steamers & Sewing Machines</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Vacuum Cleaner | Floor Care') !!}">Vacuum Cleaners & Floor Care</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Upright Vacuum') !!}">Upright Vacuums</a></li>
														<li><a href="{!! url('index/Canister Vacuum') !!}">Canister Vacuums</a></li>
														<li><a href="{!! url('index/Handheld | Stick Vacuum') !!}">Handheld & Stick Vacuums</a></li>
														<li><a href="{!! url('index/Robot Vacuum') !!}">Robot Vacuums</a></li>
														<li><a href="{!! url('index/Commercial | Garage Vacuum') !!}">Commercial & Garage Vacuums</a></li>
														<li><a href="{!! url('index/Steam Mop') !!}">Steam Mops</a></li>
														<li><a href="{!! url('index/Carpet Cleaner') !!}">Carpet Cleaners</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Bath') !!}">Bath</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Bathtub') !!}">Bathtubs</a></li>
														<li><a href="{!! url('index/Shower Head') !!}">Shower Heads</a></li>
														<li><a href="{!! url('index/Toilet') !!}">Toilets</a></li>
														<li><a href="{!! url('index/Bathroom Fixture') !!}">Bathroom Fixtures</a></li>
														<li><a href="{!! url('index/Bathroom Vanities') !!}">Bathroom Vanities</a></li>
														<li><a href="{!! url('index/Bathroom Faucet') !!}">Bathroom Faucets</a></li>
														<li><a href="{!! url('index/Shower Head') !!}">Shower Heads</a></li>
														<li><a href="{!! url('index/Bath Accessories') !!}">Bath Accessories</a></li>
														<li><a href="{!! url('index/Bath Accessory Set') !!}">Bath Accessory Sets</a></li>
														<li><a href="{!! url('index/Bathroom Mirror') !!}">Bathroom Mirrors</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Bedroom') !!}">Bedroom</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Bedding') !!}">Bedding</a></li>
														<li><a href="{!! url('index/Comforter Set') !!}">Comforter Sets</a></li>
														<li><a href="{!! url('index/Duvet Cover Set') !!}">Duvet Cover Sets</a></li>
														<li><a href="{!! url('index/Sheet') !!}">Sheets</a></li>
														<li><a href="{!! url('index/Quilt | Coverlet') !!}">Quilts & Coverlets</a></li>
														<li><a href="{!! url('index/Blanket | Throw') !!}">Blanket & Throws</a></li>
														<li><a href="{!! url('index/Mattress') !!}">Mattresses</a></li>
														<li><a href="{!! url('index/Mattress Pad | Topper') !!}">Mattress Pads & Toppers</a></li>
														<li><a href="{!! url('index/Comforter | Duvet Fill') !!}">Comforters & Duvet Fills</a></li>
														<li><a href="{!! url('index/Pillow') !!}">Pillows</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Garden') !!}">Garden</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Fire Pit & Patio Heater') !!}">Fire Pits & Patio Heaters</a></li>
														<li><a href="{!! url('index/Gas BBQ Grill') !!}">Gas BBQ Grills</a></li>
														<li><a href="{!! url('index/Hedge Trimmer') !!}">Hedge Trimmers</a></li>
														<li><a href="{!! url('index/Hot Tub') !!}">Hot Tubs</a></li>
														<li><a href="{!! url('index/Lawn Mower') !!}">Lawn Mowers</a></li>
														<li><a href="{!! url('index/Lawn Tractor') !!}">Lawn Tractors</a></li>
														<li><a href="{!! url('index/Leaf Blower') !!}">Leaf Blowers</a></li>
														<li><a href="{!! url('index/Pressure Washer') !!}">Pressure Washers</a></li>
														<li><a href="{!! url('index/String Trimmer') !!}">String Trimmers</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Tool') !!}">Tools</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Chainsaws') !!}">Chainsaws</a></li>
														<li><a href="{!! url('index/Circular Saw') !!}">Circular Saws</a></li>
														<li><a href="{!! url('index/Compound Miter Saw') !!}">Compound Miter Saws</a></li>
														<li><a href="{!! url('index/Cordless Drill') !!}">Cordless Drills</a></li>
														<li><a href="{!! url('index/Flashlight') !!}">Flashlights</a></li>
														<li><a href="{!! url('index/Portable Generator') !!}">Portable Generators</a></li>
														<li><a href="{!! url('index/Table Saw') !!}">Table Saws</a></li>
														<li><a href="{!! url('index/Wet Dry Vac') !!}">Wet Dry Vacs</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-toggle" href="{!! url('index/Auto') !!}">
												Auto
											</a>
											<ul class="dropdown-menu">
												<li><a href="{!! url('index/Car | Garage') !!}">Car & Garage</a></li>
												<li><a href="{!! url('index/Auto GPS') !!}">Auto GPS</a></li>
												<li><a href="{!! url('index/Auto Insurance') !!}">Auto Insurance</a></li>
												<li><a href="{!! url('index/Car Batterie') !!}">Car Batteries</a></li>
												<li><a href="{!! url('index/Garage Door Opener') !!}">Garage Door Openers</a></li>
												<li><a href="{!! url('index/Radar Detector') !!}">Radar Detectors</a></li>
												<li><a href="{!! url('index/Small SUV') !!}">Small SUVs</a></li>
												<li><a href="{!! url('index/Snow Blower') !!}">Snow Blowers</a></li>
												<li><a href="{!! url('index/Snow Tire') !!}">Snow Tires</a></li>
												<li><a href="{!! url('index/SUV Tire | Light Truck Tire') !!}">SUV Tires - Light Truck Tires</a></li>
												<li><a href="{!! url('index/Tire') !!}">Tires</a></li>
												<li><a href="{!! url('index/Wiper Blade') !!}">Wiper Blades</a></li>
											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-toggle" href="{!! url('index/Baby | Kid') !!}">
												Baby & Kids
											</a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu">
													<a href="{!! url('index/Baby Gear') !!}">Baby Gear</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/>Baby Carrier') !!}">Baby Carriers</a></li>
														<li><a href="{!! url('index/Baby Monitor') !!}">Baby Monitors</a></li>
														<li><a href="{!! url('index/Baby Safety Gate') !!}">Baby Safety Gates</a></li>
														<li><a href="{!! url('index/Baby Swing') !!}">Baby Swings</a></li>
														<li><a href="{!! url('index/High Chair') !!}">High Chairs</a></li>
														<li><a href="{!! url('index/Portable Crib') !!}">Portable Cribs</a></li>
														<li><a href="{!! url('index/Car Seat') !!}">Car Seats</a></li>
														<li><a href="{!! url('index/Booster Seat') !!}">Booster Seats</a></li>
														<li><a href="{!! url('index/Stroller') !!}">Strollers</a></li>
														<li><a href="{!! url('index/Double Stroller') !!}">Double Strollers</a></li>
														<li><a href="{!! url('index/Activity center') !!}">Activity centers</a></li>
														<li><a href="{!! url('index/Bathtub') !!}">Bathtubs</a></li>
														<li><a href="{!! url('index/Bottle') !!}">Bottles</a></li>
														<li><a href="{!! url('index/Baby clothes') !!}">Baby clothes</a></li>
														<li><a href="{!! url('index/Baby food') !!}">Baby food</a></li>
														<li><a href="{!! url('index/Baby formula') !!}">Baby formulas</a></li>
														<li><a href="{!! url('index/Baby jumper') !!}">Baby jumper</a></li>
														<li><a href="{!! url('index/Baby walker') !!}">Baby walkers</a></li>
														<li><a href="{!! url('index/Bouncer seat') !!}">Bouncer seats</a></li>
														<li><a href="{!! url('index/Changing table') !!}">Changing tables</a></li>
														<li><a href="{!! url('index/Diaper') !!}">Diapers</a></li>
														<li><a href="{!! url('index/Diaper bag') !!}">Diaper bags</a></li>
														<li><a href="{!! url('index/Glider | rocking chair') !!}">Gliders & rocking chairs</a></li>
														<li><a href="{!! url('index/High chair') !!}">High chairs</a></li>
														<li><a href="{!! url('index/Play yard') !!}">Play yards</a></li>
														<li><a href="{!! url('index/Safety gate') !!}">Safety gates</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Children & health') !!}">Children's health</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Thermometers') !!}">Thermometers</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/School-age kid | School age kid') !!}">School-age kids</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Backpack') !!}">Backpacks</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown">
											<a class="dropdown-toggle" href="{!! url('index/Sport | Outdoor') !!}">
												Sport & Outdoors
											</a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu">
													<a href="{!! url('index/Bike') !!}">Bikes</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Bicycle Lock') !!}">Bicycle Locks</a></li>
														<li><a href="{!! url('index/Folding Bike') !!}">Folding Bikes</a></li>
														<li><a href="{!! url('index/Kids Bike') !!}">Kids Bikes</a></li>
														<li><a href="{!! url('index/Road Bike') !!}">Road Bikes</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Hiking') !!}">Hiking</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Binocular') !!}">Binoculars</a></li>
														<li><a href="{!! url('index/Headlamp') !!}">Headlamps</a></li>
														<li><a href="{!! url('index/Hiking Boot') !!}">Hiking Boots</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Home Gym') !!}">Home Gym</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Elliptical Trainer') !!}">Elliptical Trainers</a></li>
														<li><a href="{!! url('index/Exercise Bike') !!}">Exercise Bikes</a></li>
														<li><a href="{!! url('index/Home Gym') !!}">Home Gyms</a></li>
														<li><a href="{!! url('index/Stair Climber') !!}">Stair Climbers</a></li>
														<li><a href="{!! url('index/Treadmill') !!}">Treadmills</a></li>
														<li><a href="{!! url('index/Yoga Mat') !!}">Yoga Mats</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Monitor') !!}">Monitors</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Fitness Tracker') !!}">Fitness Trackers</a></li>
														<li><a href="{!! url('index/Heart Rate Monitor') !!}">Heart Rate Monitors</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Inline Skate | Running Shoes | Sports Bra | Yoga Video') !!}">Other</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Inline Skate') !!}">Inline Skates</a></li>
														<li><a href="{!! url('index/Running Shoes') !!}">Running Shoes</a></li>
														<li><a href="{!! url('index/Sports Bras') !!}">Sports Bras</a></li>
														<li><a href="{!! url('index/Yoga Video') !!}">Yoga Videos</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li class="dropdown dropdown-reverse">
											<a class="dropdown-toggle" href="{!! url('index/Clothing | Accessories') !!}">
												Clothing & Accessories
											</a>
											<ul class="dropdown-menu">
												<li class="dropdown-submenu">
													<a href="{!! url('index/Women') !!}">Women</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Women & Dress') !!}">Dresses</a></li>
														<li><a href="{!! url('index/Women & (Shirt | Top)') !!}">Shirts & Tops</a></li>
														<li><a href="{!! url('index/Women & Hoodies | Sweatshirt') !!}">Hoodies & Sweatshirts</a></li>
														<li><a href="{!! url('index/Women & Short') !!}">Shorts</a></li>
														<li><a href="{!! url('index/Women & Pant') !!}">Pants</a></li>
														<li><a href="{!! url('index/Women & Active Wear') !!}">Active Wear</a></li>
														<li><a href="{!! url('index/Women & Underwear') !!}">Underwear</a></li>
														<li><a href="{!! url('index/Women & Bra') !!}">Bras</a></li>
														<li><a href="{!! url('index/Women & Swimwear') !!}">Swimwear</a></li>
														<li><a href="{!! url('index/Women & Sock') !!}">Socks</a></li>
														<li><a href="{!! url('index/Women & Shoes') !!}">Shoes</a></li>
														<li><a href="{!! url('index/Women & Sandal') !!}">Sandals</a></li>
														<li><a href="{!! url('index/Women & Sneaker') !!}">Sneakers</a></li>
														<li><a href="{!! url('index/Women & Boot') !!}">Boots</a></li>
														<li><a href="{!! url('index/Women & Coat | Women & Jacket') !!}">Coats & Jackets</a></li>
														<li><a href="{!! url('index/Women & Vest') !!}">Vests</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Men') !!}">Men</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Men & (Shirt | Top)') !!}">Shirts & Tops</a></li>
														<li><a href="{!! url('index/Men & Hoodies & Sweatshirt') !!}">Hoodies & Sweatshirts</a></li>
														<li><a href="{!! url('index/Men & Short') !!}">Shorts</a></li>
														<li><a href="{!! url('index/Men & Pant') !!}">Pants</a></li>
														<li><a href="{!! url('index/Men & Active Wear') !!}">Active Wear</a></li>
														<li><a href="{!! url('index/Men & Underwear') !!}">Underwear</a></li>
														<li><a href="{!! url('index/Men & Swimwear') !!}">Swimwear</a></li>
														<li><a href="{!! url('index/Men & Sock') !!}">Socks</a></li>
														<li><a href="{!! url('index/Men & Shoes') !!}">Shoes</a></li>
														<li><a href="{!! url('index/Men & Sneaker') !!}">Sneakers</a></li>
														<li><a href="{!! url('index/Men & Boot') !!}">Boots</a></li>
														<li><a href="{!! url('index/Men & (Coat | Jacket)') !!}">Coats & Jackets</a></li>
														<li><a href="{!! url('index/Men & Vest') !!}">Vests</a></li>
														<li><a href="{!! url('index/Men & Tie') !!}">Ties</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Kid') !!}">Kids</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Kid & Dress') !!}">Dresses</a></li>
														<li><a href="{!! url('index/Kid & (Shirt | Top)') !!}">Shirts & Tops</a></li>
														<li><a href="{!! url('index/Kid & Hoodies & Sweatshirt') !!}">Hoodies & Sweatshirts</a></li>
														<li><a href="{!! url('index/Kid & Short') !!}">Shorts</a></li>
														<li><a href="{!! url('index/Kid & Pant') !!}">Pants</a></li>
														<li><a href="{!! url('index/Kid & Active Wear') !!}">Active Wear</a></li>
														<li><a href="{!! url('index/Kid & Underwear') !!}">Underwear</a></li>
														<li><a href="{!! url('index/Kid & Swimwear') !!}">Swimwear</a></li>
														<li><a href="{!! url('index/Kid & Sock') !!}">Socks</a></li>
														<li><a href="{!! url('index/Kid & Shoes') !!}">Shoes</a></li>
														<li><a href="{!! url('index/Kid & Sandal') !!}">Sandals</a></li>
														<li><a href="{!! url('index/Kid & Sneaker') !!}">Sneakers</a></li>
														<li><a href="{!! url('index/Kid & Boot') !!}">Boots</a></li>
														<li><a href="{!! url('index/Kid & Coat & Jacket') !!}">Coats & Jackets</a></li>
														<li><a href="{!! url('index/Kid & Vest') !!}">Vests</a></li>
													</ul>
												</li>
												<li class="dropdown-submenu">
													<a href="{!! url('index/Accessories') !!}">Accessories</a>
													<ul class="dropdown-menu">
														<li><a href="{!! url('index/Handbag') !!}">Handbags</a></li>
														<li><a href="{!! url('index/Backpack') !!}">Backpacks</a></li>
														<li><a href="{!! url('index/Luggage') !!}">Luggage</a></li>
														<li><a href="{!! url('index/Wallet | Accessories') !!}">Wallets & Accessories</a></li>
														<li><a href="{!! url('index/Duffle Bag') !!}">Duffle Bags</a></li>
														<li><a href="{!! url('index/Messenger Bag') !!}">Messenger Bags</a></li>
														<li><a href="{!! url('index/Hat') !!}">Hats</a></li>
														<li><a href="{!! url('index/Glove') !!}">Gloves</a></li>
														<li><a href="{!! url('index/Scarves | scarf') !!}">Scarves</a></li>
														<li><a href="{!! url('index/Belt') !!}">Belts</a></li>
														<li><a href="{!! url('index/Tech Accessories') !!}">Tech Accessories</a></li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
				@yield('header')
			</header>
			
			<div role="main" class="main">
				@yield('main')
			</div>
			
			<footer id="footer">
				@yield('footer')
				<div class="footer-top">
					<p>@ 2016. All Rights Reserved.</p>
				</div>
				<div class="footer-links footer-copyright">
					<nav id="sub-menu">
						<ul>
							<li><a href="#">Computer & Tablet Reviews</a></li>
							<li><a href="#">Electronics Reviews</a></li>
							<li><a href="#">Home & Garden Reviews</a></li>
							<li><a href="#">Auto Reviews</a></li>
							<li><a href="#">Baby & Kids Reviews</a></li>
							<li><a href="#">Sports & Outdoors Reviews</a></li>
							<li><a href="#">Clothing & Accessories Reviews</a></li>
						</ul>
						<ul>
							<li><a href="#">About Us</a></li>
							<li><a href="#">TOS</a></li>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">How it Works</a></li>
						</ul>
					</nav>
				</div>
			</footer>
		</div>
		
		<!-- Vendor -->
		{!! HTML::script('vendor/jquery/jquery.min.js') !!}
		{!! HTML::script('vendor/jquery.appear/jquery.appear.min.js') !!}
		{!! HTML::script('vendor/jquery.easing/jquery.easing.min.js') !!}
		{!! HTML::script('vendor/jquery-cookie/jquery-cookie.min.js') !!}
		{!! HTML::script('vendor/bootstrap/js/bootstrap.min.js') !!}
		{!! HTML::script('vendor/common/common.min.js') !!}
		{!! HTML::script('vendor/jquery.validation/jquery.validation.min.js') !!}
		{!! HTML::script('vendor/jquery.stellar/jquery.stellar.min.js') !!}
		{!! HTML::script('vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js') !!}
		{!! HTML::script('vendor/jquery.gmap/jquery.gmap.min.js') !!}
		{!! HTML::script('vendor/jquery.lazyload/jquery.lazyload.min.js') !!}
		{!! HTML::script('vendor/isotope/jquery.isotope.min.js') !!}
		{!! HTML::script('vendor/owl.carousel/owl.carousel.min.js') !!}
		{!! HTML::script('vendor/magnific-popup/jquery.magnific-popup.min.js') !!}
		{!! HTML::script('vendor/vide/vide.min.js') !!}

		<!-- Theme Custom -->
		{!! HTML::script('js/theme.js') !!}

		<!-- Current Page Vendor and Views -->
		{!! HTML::script('vendor/rs-plugin/js/jquery.themepunch.tools.min.js') !!}
		{!! HTML::script('vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') !!}
		{!! HTML::script('vendor/circle-flip-slideshow/js/jquery.flipshow.min.js') !!}
		{!! HTML::script('js/views/view.home.js') !!}
		{!! HTML::script('js/custom.js') !!}

		<!-- Theme Initialization Files -->
		{!! HTML::script('js/theme.init.js') !!}

		@yield('scripts')

  </body>
</html>