<?php echo View::forge('global/header'); ?>


<div class="container">
	<form method="post">
	<input type="text" class="form-control" placeholder="Title" name="title" />
	<input type="text" class="form-control" placeholder="Username" name="username" />
	<textarea class="form-control" name="message"></textarea>
	<button type="submit" class="btn btn-default">send</button>
	</form>
</div>

<?php echo View::forge('global/footer'); ?>