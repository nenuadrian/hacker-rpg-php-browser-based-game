<?php echo View::forge('global/header'); ?>
<div id="cann" style="position: absolute;
    top: 0!important;
    left: 0!important;
    width: 100%;
    height: 100%;
    overflow: hidden!important;
    z-index: -1!important;
    margin: 0;
    padding: 0;
    position: fixed;
    opacity: 0.3;"> <canvas id="can" class="transparent_class" ></canvas> </div>
    <?php echo GlobalJs::include_js('hackerIntro.js'); ?>

<div class="container">
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6 text-center">

		<img src="<?php echo Uri::create('assets/img/logo.png'); ?>" class="main-logo" style="max-width:400px; width:100%; margin-top:-60px; margin-bottom:40px" />

		<form method="post">
			<?php echo View::forge('components/messages'); ?>
			<input type="text" class="form-control text-center" placeholder="user id" name="username" autocapitalize="off" autocorrect="off" />
			<input type="password" class="form-control text-center" placeholder="password" name="password" />
			<button class="btn btn-block btn-default" type="submit" style="margin-top:20px">connect</button>
		</form>

			<a class="btn btn-block btn-default" href="<?php echo Uri::create('create-account'); ?>">create a citizen account</a>

	</div>

</div>
</div>


<?php echo View::forge('global/footer'); ?>
