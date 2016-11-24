<?php echo View::forge('global/header'); ?>
<?php
	$mission = $task['data']['mission'];
?>

<style>
	.mission-interface .server {
		padding: 20px;
		background-color: #115b95;
		border-bottom: 2px solid rgba(0, 0, 0, 0.44);
		cursor:pointer;
	}
	.mission-interface .services {
		background-color: rgba(0, 0, 0, 0.44);

	}
	.mission-interface .services .service {
		border-left: 4px solid rgba(255, 255, 255, 0.14);
		padding: 10px;
		cursor:pointer;
		padding-left:20px;
	}

	.mission-interface .users {
		background-color: rgba(255, 255, 255, 0.14);
	}

	.mission-interface .user {
		padding: 5px;
		padding-left:20px;
		cursor:pointer;
	}
</style>
<div class="row mission-interface">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="text-center">
			<a class="btn" href="#objective" data-toggle="modal">objective</a>
		  <?php echo View::forge('components/modal', array('id' => 'objective', 'title' => 'Current objective', 'content' => html_entity_decode(nl2br($mission['objective']['story'])))); ?>
		</div>
		<?php if (isset($mission['task'])): ?>
			<?php echo View::forge('missions/mission_inside_task', array('task' => $mission['task'], 'task_remaining' => $task_remaining)); ?>
		<?php elseif (isset($mission['connected'])): ?>
			<div class="well">
				<?php echo $user['username']; ?> @ <?php echo $server['hostname']; ?> : <?php echo $service['port']; ?>
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
						<?php if ($entity['user_id'] != $user['user_id'] || $entity['user_id'] != $user['user_id'] || isset($entity['required_objective'])) continue; ?>
						<?php echo View::forge('missions/missions_service_' . $service['type'], array('mission' => $mission, 'entity' => $entity)); ?>
					<?php endforeach;?>
				<?php endif; ?>
			</div>
	  <?php else: ?>
			<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task['remaining'], 'duration' => $task['task_duration'], 'max_width' => '100px')); ?>

			<?php foreach(array_filter($mission['servers'], function($s) { return $s['discovered']; }) as $server_id => $s):
					$knownServices = 0;
					foreach($mission['services'] as $serv) if ($serv['discovered'] && $serv['quest_server_id'] == $server_id && !isset($service['required_objective'])) $knownServices++;
				?>
				<div class="server" onclick="$('#services_<?php echo $server_id; ?>').collapse('toggle');">
					<h4><?php echo $s['ip']; ?></h4>
					<small><?php echo isset($s['custom_name']) ? $s['custom_name'] : ($s['hide_hn'] ? 'unknown hostname' : $s['hostname']); ?> - <?php echo $knownServices; ?> known services</small>
				</div>
				<div class="services collapse" id="services_<?php echo $server_id; ?>">
					<div style="padding:20px;">
						<?php foreach($mission['services'] as $service_id => $service): if (!$service['discovered'] || $service['quest_server_id'] != $server_id || isset($service['required_objective'])) continue; ?>
							<?php $type = Config::get('service_types')[$service['type']]; ?>
							<div class="service" onclick="$('#users_<?php echo $service_id; ?>').collapse('toggle');">
								<i class="fa fa-<?php echo $type['icon']; ?>"></i> <?php echo $type['name']; ?> | PORT <?php echo $service['port']; ?>
							</div>
							<div class="users collapse" id="users_<?php echo $service_id; ?>">
								<div style="padding:15px">
									<?php foreach($mission['users'] as $user_id => $user): if ($user['service_id'] != $service_id) continue; ?>
										<?php echo View::forge('components/modal', array('id' => 'user_' . $user_id, 'title' => $user['username'], 'content' => View::forge('missions/missions_service_user', array('user' => $user)))); ?>

										<div class="user" onclick="$('#user_<?php echo $user_id; ?>').modal('toggle')">
											<?php echo $user['username']; ?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
					  <?php endforeach; ?>


						<form method="post" class="text-center">
							<input type="hidden" name="server_action" value="<?php echo $server_id; ?>"/>
							<button type="submit" class="btn btn-default" name="action" value="scan">nmap for services</button>
						</form>

						<form method="post" class="text-center">
							<input type="hidden" name="server_action" value="<?php echo $server_id; ?>"/>
							<input name="custom_name" value="<?php echo isset($s['custom_name']) ? $s['custom_name'] : ''; ?>" placeholder="Custom name" class="form-control" />
							<button type="submit" class="btn btn-default" name="action" value="set_name">set name</button>
						</form>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>


	<br/><br/>

<?php
/*
<div class="row">
	<?php if (isset($mission['task'])): ?>
		<?php echo View::forge('missions/mission_inside_task', array('task' => $mission['task'], 'task_remaining' => $task_remaining)); ?>
	<?php else: ?>
	<div class="col-md-3 ">
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
		<?php endif; ?>
	</div>
<?php endif; ?>
</div>*/ ?>


<?php if (Auth::get('group') == 2): ?>
	<br/><br/><br/>
	<form method="post">
		<button class="btn btn-danger btn-block" type="submit" name="cancel" value="true">cancel</button>
	</form>
	<button class="btn btn-default btn-block"  data-toggle="collapse" href="#debug" >debug</button>
<div class="well collapse" id="debug">
<pre>
<?php var_export($task); ?>
</pre>
</div>

<?php endif; ?>
<?php echo View::forge('global/footer'); ?>
