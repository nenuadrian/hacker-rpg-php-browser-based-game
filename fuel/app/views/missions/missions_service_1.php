
	<form method="post">
		<button type="submit" name="entity_action" value="<?php echo $entity['entity_id']; ?>" class="btn btn-default">
			<?php echo $entity['title'] ;?> <?php echo isset($entity['running']) ? 'running' : ''; ?>
		</button><br/>
		<small>
			<?php echo $entity['security'] ? 'encrypted' : 'unencrypted'; ?>
			<?php echo $entity['type'] == 1 ? 'executable' : ''; ?>
		</small>
	</form>
