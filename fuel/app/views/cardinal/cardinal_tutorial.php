<?php echo View::forge('global/header'); ?>

<div class="container">

	<?php foreach($steps as $step): ?>
		<h1>Step <?php echo $step['step_id']; ?></h1>
		<br/>
		<div class="well">
			<form method="post" class="text-center">
				<div class="row">
					<div class="col-md-3">
						<input type="text" name="step_id" value="<?php echo $step['step_id']; ?>" class="form-control" />
					</div>
					<div class="col-md-9">
						<input type="text" name="title" value="<?php echo $step['title']; ?>"  class="form-control" />
					</div>
				</div>
			<textarea name="completion_conditions" class="form-control" ><?php echo $step['completion_conditions']; ?></textarea>
			<textarea name="story" class="form-control" placeholder="Story"><?php echo $step['story']; ?></textarea>
			<button type="submit" class="btn btn-default" name="update" value="<?php echo $step['step_id']; ?>">update</button>
			</form>
		</div>
		<br/>
	<?php endforeach; ?>

</div>

<?php echo View::forge('global/footer'); ?>
