<?php echo View::forge('global/header'); ?>

<div class="container">
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6 text-center">

		<?php echo View::forge('components/messages'); ?>

		<form method="post" style="margin-top:50px">
			<div class="row">
				<div class="col-xs-6">
					<input type="text" class="form-control text-center" placeholder="nickname" name="username" required value="<?php echo Input::post('username', ''); ?>" autocapitalize="off" autocorrect="off" maxlength="30" />
				</div>
				<div class="col-xs-6">
					<input type="password" class="form-control text-center" placeholder="password" name="password" required value="<?php echo Input::post('password', ''); ?>" maxlength="30" />
				</div>
			</div>
			<input type="email" class="form-control text-center" placeholder="email (bonus on confirm)" name="email" required value="<?php echo Input::post('email', ''); ?>" autocapitalize="off" autocorrect="off" maxlength="255" />
			<br/>
			<p>
			I fully agree with the <a href="<?php echo Uri::create('pages/view/terms-of-service'); ?>">terms of service</a> && <a href="<?php echo Uri::create('pages/view/privacy-policy'); ?>">privacy policy</a> and would like to
			</p>
			<button class="btn btn-block btn-default" type="submit" style="margin-top:20px">obtain citizenship</button>
		</form>

	</div>

</div>
</div>
<?php echo View::forge('global/footer'); ?>
