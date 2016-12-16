<?php echo View::forge('global/header'); ?>


<div class="container text-center">
	<div class="row">
		<div class="col-sm-4">
			<a href="<?php echo Uri::create('cardinal/missions'); ?>"><h1><i class="fa fa-crosshairs" aria-hidden="true"></i></h1></a>
		</div>
		<div class="col-sm-4">
			<a href="<?php echo Uri::create('cardinal/tutorial'); ?>"><h1><i class="fa fa-graduation-cap" aria-hidden="true"></i></h1></a>
		</div>
		<div class="col-sm-4">
			<a href="<?php echo Uri::create('cardinal/feedback'); ?>"><h1><i class="fa fa-smile-o" aria-hidden="true"></i></h1></a>
		</div>
</div>

<?php echo View::forge('global/footer'); ?>
