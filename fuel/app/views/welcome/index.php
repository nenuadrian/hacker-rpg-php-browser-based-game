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
    <?php echo Asset::js('hackerIntro.js'); ?>

<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4 text-center">

		<img src="http://secretrepublic.net/layout/img/logo-art.png" class="main-logo" style="margin-top:50px;max-width:400px; width:100%;" />
		<form method="post" style="margin-top:40px;margin-bottom:30px;">
			<?php echo View::forge('components/messages'); ?>
			<input type="text" class="form-control text-center" placeholder="user id" name="username"/>
			<input type="password" class="form-control text-center" placeholder="password" name="password" />
			<button class="btn btn-block btn-default" type="submit" style="margin-top:20px">connect</button>
		</form>

			<a class="btn btn-block btn-default" href="<?php echo Uri::create('create-account'); ?>">create a citizen account</a>

	</div>

</div>


<?php echo View::forge('global/footer'); ?>
