<?php echo View::forge('global/header'); ?>


<div class="container">
	<div class="text-center">
		<div style="display:inline-block; max-width:100px;margin-top:50px">
		<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task['remaining'], 'duration' => $task['task_duration'])); ?>
		</div>
	</div>


		<?php if (isset($output)): ?>
			<?php if (is_array($output)): ?>
				<?php if (!count($output)): ?>
					your query did not match any results
				<?php else: ?>
					<table class="table">
					<thead>
						<?php foreach(array_keys($output[0]) as $col): ?>
							<th><?php echo $col; ?></th>
						<?php endforeach; ?>
					</thead>
					<tbody>
						<?php foreach($output as $row): ?>
							<tr>
							<?php foreach($row as $col => $v): ?>
								<td><?php echo $v; ?></td>
							<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
					</table>
				<?php endif ;?>
			<?php else: ?>
				<?php echo $output; ?>
			<?php endif; ?>
		<?php endif;?>
		<form method="post" class="text-center">
		<textarea name="query" class="form-control"><?php echo Input::post('query'); ?></textarea>
		<button type="submit" class="btn btn-default">Execute CQL query</button>
		</form>

	
</div>
<?php echo View::forge('global/footer'); ?>