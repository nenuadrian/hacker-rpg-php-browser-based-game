<div class="col-md-12 text-center">

	<div style="display:inline-block; max-width:100px;margin-top:50px">
<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task_remaining, 'duration' => $task['task_duration'])); ?>
</div>
	<form method="post">
	<?php if (Auth::get('group') == 2): ?>
		<button type="submit" name="skip" value="true" class="btn btn-success">skip</button>
	<?php endif; ?>
		<button type="submit" name="cancel" value="true" class="btn btn-danger">cancel</button>
	</form>
</div>