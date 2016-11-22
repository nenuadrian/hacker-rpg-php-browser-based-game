<?php echo View::forge('global/header'); ?>


<?php 
	$mission = $task['data']['mission'];
?>
<div class="row">
	<?php if (isset($mission['task'])): ?>
		<?php echo View::forge('missions/mission_inside_task', array('task' => $mission['task'], 'task_remaining' => $task_remaining)); ?>
	<?php else: ?>
	<div class="col-md-3 ">
				<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task['remaining'], 'duration' => $task['task_duration'], 'max_width' => '100px')); ?>
<br/>
			<div class="list-group">
 
			<?php foreach($mission['servers'] as $server_id => $s): ?>
				<?php if (!$s['discovered']) continue; ?>
				<?php echo View::forge('components/modal', array('id' => 'serverModal_' . $server_id, 'title' => $s['hostname'], 'content' => 
				View::forge('missions/mission_server_services', array('s' => $s, 'services' => $mission['services'], 'server_id' => $server_id)))); ?>
				      	
				<a data-toggle="modal" data-target="#serverModal_<?php echo $server_id; ?>" class="list-group-item <?php echo isset($mission['connected']) && $server_id == $service['quest_server_id'] ? 'active' : ''; ?>">
					<p><?php echo $s['ip']; ?></p>
					<small><?php echo isset($s['custom_name']) ? $s['custom_name'] : ($s['hide_hn'] ? 'unknown hostname' : $s['hostname']); ?></small>
				</a>

			<?php endforeach; ?>
				<a data-toggle="modal" data-target="#ping" class="list-group-item text-center">
				<strong>ping</strong>
				</a>
		</div>

		<?php echo View::forge('components/modal', array('id' => 'ping', 'title' => 'ping server', 'content' => 
				'<form method="post">
					<input type="text" name="ip" placeholder="Target" class="form-control" />
					<button type="submit" class="btn btn-default " name="ping" value="true">ping</button>
				</form>')); ?>
				


		<h4>bouncing through</h4>
		<?php if (!count($mission['bouncers'])): ?>
			<p>not bouncing through any servers</p>
		<?php else: ?>
			<?php foreach($mission['bouncers'] as $b): ?>
				<p>
				<?php echo $mission['servers'][$b]['hostname']; ?> <?php echo $mission['servers'][$b]['bounces']; ?> left
				<form method="post">
				<button type="submit" class="btn btn-default" name="remove_bounce" value="<?php echo $b; ?>">remove</button>
				</form>
				</p>

			<?php endforeach; ?>

		<?php endif; ?>
	</div>
	<div class="col-md-9">
		<?php if (isset($mission['connected'])): ?>
			<div class="well">
				<?php echo $mission['connected']['username']; ?> @ <?php echo $server['hostname']; ?> : <?php echo $service['port']; ?>
			<form method="post">
				<button type="submit" class="btn btn-default" name="service_action" value="disconnect">disconnect</button>
				<?php if ($service['type'] == 1): ?>
					<button type="submit" class="btn btn-default" name="service_action" value="bounce">add as bounce</button>
				<?php endif; ?>
			</form>
				</div>
			<?php if (isset($mission['connected']['entity'])): ?>
				<?php echo View::forge('missions/mission_entity_'. $service['type'], array('mission' => $mission, 'entity' => $entity)); ?>
			<?php else: ?>
				<p>
				<?php echo $service['welcome']; ?>
				</p>

				<?php foreach($mission['entities'] as $entity_id => $entity): ?>
					<?php if ($entity['service_id'] != $mission['connected']['service_id'] || $entity['owner'] != $mission['connected']['username'] || isset($entity['required_objective'])) continue; ?>
					<?php echo View::forge('missions/missions_service_' . $service['type'], array('mission' => $mission, 'entity' => $entity, 'entity_id' => $entity_id)); ?>
				<?php endforeach;?>
			<?php endif; ?>
		<?php else: ?>
			<div class="well">
			Not connected to any service.
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
</div>
	<div class="container well">
	<?php echo html_entity_decode(nl2br($mission['objective']['story'])); ?>
	</div>

<?php if (Auth::get('group') == 2): ?>
	<button class="btn btn-default btn-block"  data-toggle="collapse" href="#debug" >debug</button>
<div class="well collapse" id="debug">
<pre>
<?php var_export($task); ?>
</pre>
</div>

<?php endif; ?>
<?php echo View::forge('global/footer'); ?>