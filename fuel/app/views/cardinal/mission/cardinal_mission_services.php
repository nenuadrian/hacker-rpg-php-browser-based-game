<?php foreach($services as $service_id => $service): if ($service['quest_server_id'] != $server_id) continue; ?>
	<?php $type = Config::get('service_types')[$service['type']]; ?>
	<button id="anchor_service_<?php echo $service_id; ?>" class="btn btn-default btn-block" data-toggle="collapse" data-target="#service_<?php echo $service_id; ?>">
			Service <?php echo $service['port']; ?> | <?php echo $type['name']; ?> | ID(<?php echo $service_id; ?>)
	</button>
	<div class="collapse <?php echo $expanded['service'] == $service_id ? 'in' : ''; ?>" id="service_<?php echo $service_id; ?>" >
		<div class ="well">
			<?php echo View::forge('components/modal', array('id' => 'service-' . $service_id, 'title' => $type['name'], 'content' => View::forge('cardinal/mission/cardinal_mission_service_edit', array('service_id' => $service_id, 'service' => $service, 'objectives' => $objectives)))); ?>

			<a data-toggle="modal" data-target="#service-<?php echo $service_id; ?>" class="btn btn-block">edit</a>
			<?php echo View::forge('cardinal/mission/cardinal_mission_users', array('service' => $service, 'users' => $users, 'entities' => $entities, 'service_id' => $service_id, 'expanded' => $expanded, 'objectives' => $objectives)); ?>
		</div>
	</div>
<?php endforeach; ?>
