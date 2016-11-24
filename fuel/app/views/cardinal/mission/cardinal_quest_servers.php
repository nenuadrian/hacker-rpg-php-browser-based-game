<?php echo View::forge('global/header'); ?>
<?php

$expanded = array(
	'service' => Input::get('service_id'),
	'entity' => Input::get('entity_id'),
	'server' => Input::get('quest_server_id'),
	'user' => Input::get('user_id')
);

if (Input::get('user_id')) {
	$expanded['service'] = $users[$expanded['user']]['service_id'];
	$expanded['server'] = $services[$expanded['service']]['quest_server_id'];
}

if (Input::get('service_id')) {
	$expanded['server'] = $services[$expanded['service']]['quest_server_id'];
}

if (Input::get('entity_id')) {
	$expanded['user'] = $entities[Input::get('entity_id')]['user_id'];
	$expanded['service'] = $users[$expanded['user']]['service_id'];
	$expanded['server'] = $services[$expanded['service']]['quest_server_id'];
}

?>
	<?php echo View::forge('cardinal/mission/cardinal_quest_menu', array('quest' => $quest)); ?>

		<form method="post">
		<button class="btn btn-default btn-block" type="submit" name="add_server" value="true">add server</button>
		</form>
	<?php foreach($servers as $server_id => $s): ?>
		<button id="anchor_server_<?php echo $server_id; ?>" class="btn btn-default btn-block" data-toggle="collapse" data-target="#server_<?php echo $server_id; ?>">
  			<?php echo $s['hostname']; ?> | <?php echo $s['discovered'] ? 'discovered' : 'not discovered'; ?> | N(<?php echo $s['network']; ?>) | ID(<?php echo $server_id; ?>)
		</button>

		<div class="collapse well <?php echo $expanded['server'] == $server_id ? 'in' : ''; ?>" id="server_<?php echo $server_id; ?>" >

			<form method="post" action="#anchor_server_<?php echo $server_id; ?>">
			<input type="hidden" name="quest_server_id" value="<?php echo $server_id; ?>" />
			<div class="row">
			<div class="col-xs-4">
			<input type="text" name="hostname" class="form-control" value="<?php echo $s['hostname']; ?>" />
			</div>
			<div class="col-xs-2">
			<select class="form-control" name="discovered">
							<option value="0">Undiscovered</option>
							<option value="1" <?php echo $s['discovered'] ? 'selected' : ''; ?>>Discovered</option>
							</select>
			</div>
			<div class="col-xs-2">
				<select class="form-control" name="hide_hn">
					<option value="0">Visible hn</option>
					<option value="1" <?php echo $s['hide_hn'] ? 'selected' : ''; ?>>Hidden hn</option>
				</select>
			</div>
			<div class="col-xs-2">
			<input type="number" name="network" class="form-control" value="<?php echo $s['network']; ?>" placeholder="Network"/>
			</div>
			<div class="col-xs-2">
			<input type="number" name="bounces" class="form-control" value="<?php echo $s['bounces']; ?>" placeholder="Bounces"/>
			</div>
			</div>
			<div class="text-center">
			<button class="btn btn-default " type="submit">update</button>
			<button class="btn btn-default" type="submit" name="add_service" value="true">add service</button>
			<button class="btn btn-danger" type="submit" name="delete" value="true">erase</button>
			</div>
			</form>
			<?php echo View::forge('cardinal/mission/cardinal_mission_services', array('services' => $services, 'entities' => $entities, 'server_id' => $server_id, 'expanded' => $expanded, 'objectives' => $objectives, 'users' => $users)); ?>

		</div>
	<?php endforeach; ?>
<?php echo View::forge('global/footer'); ?>
