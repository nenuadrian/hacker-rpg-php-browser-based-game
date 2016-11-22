
	<form method="post"> 
		<button type="submit" name="entity_action" value="<?php echo $entity_id; ?>" class="btn btn-default">
			<?php echo $entity['title'] ;?> <?php echo isset($entity['running']) ? 'running' : ''; ?>
		</button>
	</form>
