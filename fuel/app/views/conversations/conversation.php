<?php echo View::forge('global/header'); ?>




<div class="container">
<?php print_r($conv); ?>
<?php print_r($replies); ?>

	<form method="post">
	<textarea class="form-control" name="message"></textarea>
	<button type="submit" class="btn btn-default">send</button>
	</form>
</div>

<?php echo View::forge('global/footer'); ?>