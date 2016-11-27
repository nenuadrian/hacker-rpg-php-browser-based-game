<?php echo View::forge('global/header'); ?>

<div class="container">
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6 text-center">

		<?php echo View::forge('components/messages'); ?>

		<form method="post" style="margin-top:50px">
			<input type="text" class="form-control text-center" placeholder="user id" name="username" required value="<?php echo Input::post('username', ''); ?>" autocapitalize="off" autocorrect="off" />
			<input type="email" class="form-control text-center" placeholder="e-mail" name="email" required value="<?php echo Input::post('email', ''); ?>" autocapitalize="off" autocorrect="off" />
			<input type="password" class="form-control text-center" placeholder="password" name="password" required value="<?php echo Input::post('password', ''); ?>" />
			<br/>
			<p>
			I fully agree with the <a href="<?php echo Uri::create('terms-of-service'); ?>">Terms of service</a> & <a href="<?php echo Uri::create('privacy-policy'); ?>">Privacy policy</a>.
			</p>
			<button class="btn btn-block btn-default" type="submit" style="margin-top:20px">obtain citizenship</button>
		</form>
		<Br/>
		<a href="<?php echo Uri::base();?>" class="btn btn-default">
			home
			</a>

	</div>

</div>
</div>
<?php echo View::forge('global/footer'); ?>
