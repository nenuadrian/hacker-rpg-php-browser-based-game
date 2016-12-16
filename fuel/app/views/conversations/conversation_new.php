<?php echo View::forge('global/header'); ?>


<div class="container">
	<div class="well text-center">
	<form method="post">
		<div class="row">
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo Input::post('title'); ?>" required/>
			</div><div class="col-md-6">
				<input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo Input::post('username', $to); ?>" required/>
			</div></div>
			<textarea class="form-control" name="message" required><?php echo Input::post('message'); ?></textarea>
			<button type="submit" class="btn btn-default">send</button>
	</form>
</div>
</div>

<?php echo View::forge('global/footer'); ?>
