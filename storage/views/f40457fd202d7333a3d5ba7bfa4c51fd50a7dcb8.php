<?php $__env->startSection('title', 'Error'); ?>

<?php $__env->startSection('message', 'Whoops, looks like something went wrong.'); ?>

<?php echo $__env->make('errors::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>