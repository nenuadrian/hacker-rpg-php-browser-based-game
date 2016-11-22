<?php echo View::forge('global/header'); ?>

<div class="container">

	<?php foreach($steps as $step): ?>

		<div class="well">
			<h1>Step <?php echo $step['step_id']; ?></h1>
			<hr/>
			<form method="post" class="text-center">
			<input type="text" name="step_id" value="<?php echo $step['step_id']; ?>" class="form-control" />
			<input type="text" name="title" value="<?php echo $step['title']; ?>"  class="form-control" />
			<textarea name="completion_conditions" class="form-control" ><?php echo $step['completion_conditions']; ?></textarea>
			<textarea name="story" class="form-control" ><?php echo $step['story']; ?></textarea>
			<button type="submit" class="btn btn-default" name="update" value="<?php echo $step['step_id']; ?>">update</button>
			</form>	
		</div>
	<?php endforeach; ?>

</div>

<?php echo View::forge('global/footer'); ?>
