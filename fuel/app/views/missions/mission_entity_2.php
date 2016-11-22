<em><?php echo $entity['title'] ;?></em> <?php echo $entity['type'] ;?> <strong><?php echo $entity['sender_receiver'] ;?></strong>

<form method="post">

<?php if (!$entity['security']): ?>

		<div class="entity-content">
			<?php echo html_entity_decode(nl2br($entity['content'])); ?>
		</div>
	<button type="submit" class="btn btn-default" name="action" value="erase">erase</button>

<?php else: ?>
	<?php if ($entity['security']): ?>
    	<button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
    <?php endif; ?>

<?php endif; ?>

</form>