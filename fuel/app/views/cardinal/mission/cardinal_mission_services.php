<?php foreach($services as $service_id => $service): if ($service['quest_server_id'] != $server_id) continue; ?>
	<?php $type = \Model\Missions::$service_types[$service['type']]; ?>
	<div class="box-layout" id="anchor_service_<?php echo $service_id; ?>">
		<div class="box-layout-alert">
			<a class="box-layout-icon " data-toggle="collapse" data-target="#service_<?php echo $service_id; ?>">
					<div class="front-content">
							<h3>PORT <?php echo $service['port']; ?> | <?php echo $type['name']; ?></h3>
					</div>
			</a>
			<a class="box-layout-content" data-toggle="collapse" data-target="#service_<?php echo $service_id; ?>">
					<h3>ID(<?php echo $service_id; ?>)</h3>
					<p><?php echo substr($service['welcome'], 0, 250); ?>...</p>
			</a>
		</div>
	</div>

	<div class="collapse <?php echo $expanded['service'] == $service_id ? 'in' : ''; ?>" id="service_<?php echo $service_id; ?>" >
		<div style="padding:20px">
			<?php echo View::forge('components/modal', array('id' => 'service-' . $service_id, 'title' => $type['name'], 'content' => View::forge('cardinal/mission/cardinal_mission_service_edit', array('service_id' => $service_id, 'service' => $service, 'objectives' => $objectives)))); ?>

			<a data-toggle="modal" data-target="#service-<?php echo $service_id; ?>" class="btn btn-block">edit</a>
			<?php echo View::forge('cardinal/mission/cardinal_mission_users', array('service' => $service, 'users' => $users, 'entities' => $entities, 'service_id' => $service_id, 'expanded' => $expanded, 'objectives' => $objectives)); ?>
		</div>
	</div>
<?php endforeach; ?>
