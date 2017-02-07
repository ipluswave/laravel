<?php $__env->startSection('main'); ?>
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<?php if(session()->has('error')): ?>
					<?php echo $__env->make('partials/error', ['type' => 'danger', 'message' => session('error')], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endif; ?>	
				<hr>	
				<h2 class="intro-text text-center"><?php echo e(trans('front/login.connection')); ?></h2>
				<hr>
				<p><?php echo e(trans('front/login.text')); ?></p>				
				
				<?php echo Form::open(['url' => 'auth/login', 'method' => 'post', 'role' => 'form']); ?>	
				
				<div class="row">

					<?php echo Form::control('text', 6, 'log', $errors, trans('front/login.log')); ?>

					<?php echo Form::control('password', 6, 'password', $errors, trans('front/login.password')); ?>

					<?php echo Form::submit(trans('front/form.send'), ['col-lg-12']); ?>

					<?php echo Form::check('memory', trans('front/login.remind')); ?>

					<?php echo Form::text('address', '', ['class' => 'hpet']); ?>		  
					<div class="col-lg-12">					
						<?php echo link_to('password/email', trans('front/login.forget')); ?>

					</div>

				</div>
				
				<?php echo Form::close(); ?>


				<div class="text-center">
					<hr>
						<h2 class="intro-text text-center"><?php echo e(trans('front/login.register')); ?></h2>
					<hr>	
					<p><?php echo e(trans('front/login.register-info')); ?></p>
					<?php echo link_to('auth/register', trans('front/login.registering'), ['class' => 'btn btn-default']); ?>

				</div>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>