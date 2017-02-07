<?php $__env->startSection('main'); ?>

    <div class="row">

        <div class="col-lg-12">
            <?php echo Form::open(['url' => 'blog/search', 'method' => 'get', 'role' => 'form', 'class' => 'pull-right']); ?>  
                <?php echo Form::control('text', 12, 'search', $errors, null, null, null, trans('front/blog.search')); ?>

            <?php echo Form::close(); ?>

        </div>

    </div>

    <div class="row">

        <?php foreach($posts as $post): ?>
            <div class="box">
                <div class="col-lg-12 text-center">
                    <h2><?php echo e($post->title); ?>

                    <br>
                    <small><?php echo e($post->user->username); ?> <?php echo e(trans('front/blog.on')); ?> <?php echo $post->created_at . ($post->created_at != $post->updated_at ? trans('front/blog.updated') . $post->updated_at : ''); ?></small>
                    </h2>
                </div>
                <div class="col-lg-12">
                    <p><?php echo $post->summary; ?></p>
                </div>
                <div class="col-lg-12 text-center">
                    <?php echo link_to('blog/' . $post->slug, trans('front/blog.button'), ['class' => 'btn btn-default btn-lg']); ?>

                    <hr>
                </div>
            </div>
        <?php endforeach; ?>
     
        <div class="col-lg-12 text-center">
            <?php echo $links; ?>

        </div>

    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>