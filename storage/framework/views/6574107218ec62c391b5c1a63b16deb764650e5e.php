<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo e(trans('front/site.title')); ?></title>
		<meta name="description" content="">	
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php echo $__env->yieldContent('head'); ?>

		<?php echo HTML::style('css/main_front.css'); ?>


		<!--[if (lt IE 9) & (!IEMobile)]>
			<?php echo HTML::script('js/vendor/respond.min.js'); ?>

		<![endif]-->
		<!--[if lt IE 9]>
			<?php echo HTML::style('https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js'); ?>

			<?php echo HTML::style('https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>

		<![endif]-->

		<?php echo HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'); ?>

		<?php echo HTML::style('http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic'); ?>


	</head>

  <body>

	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<header role="banner">

		<div class="brand"><?php echo e(trans('front/site.title')); ?></div>
		<div class="address-bar"><?php echo e(trans('front/site.sub-title')); ?></div>
		<div id="flags" class="text-center"></div>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html"><?php echo e(trans('front/site.title')); ?></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li <?php echo classActivePath('/'); ?>>
							<?php echo link_to('/', trans('front/site.home')); ?>

						</li>
						<?php if(session('statut') == 'visitor' || session('statut') == 'user'): ?>
							<li <?php echo classActivePath('contact/create'); ?>>
								<?php echo link_to('contact/create', trans('front/site.contact')); ?>

							</li>
						<?php endif; ?>
						<li <?php echo classActiveSegment(1, ['articles', 'blog']); ?>>
							<?php echo link_to('articles', trans('front/site.blog')); ?>

						</li>
						<?php if(Request::is('auth/register')): ?>
							<li class="active">
								<?php echo link_to('auth/register', trans('front/site.register')); ?>

							</li>
						<?php elseif(Request::is('password/email')): ?>
							<li class="active">
								<?php echo link_to('password/email', trans('front/site.forget-password')); ?>

							</li>
						<?php else: ?>
							<?php if(session('statut') == 'visitor'): ?>
								<li <?php echo classActivePath('auth/login'); ?>>
									<?php echo link_to('auth/login', trans('front/site.connection')); ?>

								</li>
							<?php else: ?>
								<?php if(session('statut') == 'admin'): ?>
									<li>
										<?php echo link_to_route('admin', trans('front/site.administration')); ?>

									</li>
								<?php elseif(session('statut') == 'redac'): ?> 
									<li>
										<?php echo link_to('blog', trans('front/site.redaction')); ?>

									</li>
								<?php endif; ?>
								<li>
									<?php echo link_to('auth/logout', trans('front/site.logout')); ?>

								</li>
							<?php endif; ?>
						<?php endif; ?>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#"><img width="32" height="32" alt="<?php echo e(session('locale')); ?>"  src="<?php echo asset('img/' . session('locale') . '-flag.png'); ?>" />&nbsp; <b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php foreach( config('app.languages') as $user): ?>
								<?php if($user !== config('app.locale')): ?>
									<li><a href="<?php echo url('language'); ?>/<?php echo e($user); ?>"><img width="32" height="32" alt="<?php echo e($user); ?>" src="<?php echo asset('img/' . $user . '-flag.png'); ?>"></a></li>
								<?php endif; ?>
							<?php endforeach; ?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php echo $__env->yieldContent('header'); ?>	
	</header>

	<main role="main" class="container">
		<?php if(session()->has('ok')): ?>
			<?php echo $__env->make('partials/error', ['type' => 'success', 'message' => session('ok')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>	
		<?php if(isset($info)): ?>
			<?php echo $__env->make('partials/error', ['type' => 'info', 'message' => $info], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>
		<?php echo $__env->yieldContent('main'); ?>
	</main>

	<footer role="contentinfo">
		 <?php echo $__env->yieldContent('footer'); ?>
		<p class="text-center"><small>Copyright &copy; Momo</small></p>
	</footer>
		
	<?php echo HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); ?>

	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
	<?php echo HTML::script('js/plugins.js'); ?>

	<?php echo HTML::script('js/main.js'); ?>


	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
		(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
		e=o.createElement(i);r=o.getElementsByTagName(i)[0];
		e.src='//www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
		ga('create','UA-XXXXX-X');ga('send','pageview');
	</script>

	<?php echo $__env->yieldContent('scripts'); ?>

  </body>
</html>