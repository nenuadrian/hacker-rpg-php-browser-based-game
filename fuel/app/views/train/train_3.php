<?php echo View::forge('global/header'); ?>


<div class="container">
	<div class="row">
		<div class="col-md-4">
		<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task['remaining'], 'duration' => $task['task_duration'], 'max_width' => '100px')); ?>
	</div>
	<div class="col-md-8">
		<div class="well">
			<?php echo html_entity_decode($instructions); ?>
		</div>
	</div>
</div>
		<?php echo View::forge('missions/query_output', array('output' => isset($output) ? $output : false)); ?>
	
		<form method="post" class="text-center">
		<textarea name="query" class="form-control"><?php echo Input::post('query'); ?></textarea>
		<button type="submit" class="btn btn-default">Execute CQL query</button>
		</form>


</div>
<?php echo View::forge('global/footer'); ?>
