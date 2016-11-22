<?php if (!$entity['security']): ?>
		<div class="entity-content">
			<?php $header = explode('|', $entity['content']); ?>
  		<table class="table">
  			<thead>
  			<?php foreach($header as $th): ?>
  				<th><?php echo $th; ?></th>
  			<?php endforeach; ?>
  				<th></th>
  			</thead>
  			<tbody>
  				<?php foreach($mission['entities'] as $ee_id => $ee): ?>
					<?php if ($ee['parent_entity_id'] != $entity['entity_id']) continue; ?>
					<?php $row = explode('|', $ee['title']); ?>
					<tr>
						<?php foreach($row as $td): ?>
		      				<td><?php echo $td; ?></td>
		      			<?php endforeach; ?>
		      			<td></td>
	      			</tr>
				<?php endforeach; ?>
  			</tbody>
  		</table>
		</div>
	<?php else: ?>
<form method="post" class="text-center">
	<input type="hidden" name="entity_action" value="<?php echo $entity_id; ?>"/>
	<?php if ($entity['security']): ?>
    	<button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
    <?php endif; ?>
</form>
<?php endif; ?>