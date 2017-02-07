<?php $__env->startSection('main'); ?>
	<div class="row">
		<div class="box">
			<div class="col-lg-12">
				<hr>	
				<h2 class="intro-text text-center"><?php echo e(trans('front/contact.title')); ?></h2>
				<hr>
				<p><?php echo e(trans('front/contact.text')); ?></p>				
				
				<?php echo Form::open(['url' => 'contact', 'method' => 'post', 'role' => 'form']); ?>	
				
					<div class="row">

						<?php echo Form::control('text', 6, 'name', $errors, trans('front/contact.name')); ?>

						<?php echo Form::control('email', 6, 'email', $errors, trans('front/contact.email')); ?>

						<?php echo Form::control('textarea', 12, 'message', $errors, trans('front/contact.message')); ?>

						<?php echo Form::text('address', '', ['class' => 'hpet']); ?>		

					  	<?php echo Form::submit(trans('front/form.send'), ['col-lg-12']); ?>


					</div>
					
				<?php echo Form::close(); ?>


			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>