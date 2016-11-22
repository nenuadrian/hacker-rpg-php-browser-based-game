<?php echo View::forge('global/header'); ?>


<div class="container text-center">
	<a href="<?php echo Uri::create('cardinal/missions'); ?>"><h1><i class="fa fa-crosshairs" aria-hidden="true"></i></h1></a>
	<a href="<?php echo Uri::create('cardinal/tutorial'); ?>"><h1><i class="fa fa-graduation-cap" aria-hidden="true"></i></h1></a>
</div>

<?php echo View::forge('global/footer'); ?>
