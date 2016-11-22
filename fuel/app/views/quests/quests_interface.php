<?php echo View::forge('global/header'); ?>


<?php print_r($task); ?>
<style>
.server {
	display: block;
	background: rgba(1, 115, 204, 0.08);
	padding:15px;
	cursor:pointer;
}
.service {
	padding: 10px;
	border: 1px solid rgba(1, 115, 204, 0.48);
}

.entity {
	display: block;
	background: rgba(1, 115, 204, 0.08);
	padding:15px;
	cursor:pointer;
}

</style>

<div class="text-center">
		<div style="display:inline-block; max-width:100px;margin-top:50px">
		<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task['remaining'], 'duration' => $task['task_duration'])); ?>
		</div>
	</div>
<?php 

	$mission = $task['data']['mission'];
?>
<div class="row">
	<?php if (isset($mission['task'])): ?>
		<div class="col-md-12 text-center">

			<div style="display:inline-block; max-width:100px;margin-top:50px">
		<?php echo View::forge('components/countdown', array('start_value' => $mission['task']['task_start'], 'remaining' => $task_remaining, 'duration' => $mission['task']['task_duration'])); ?>
		</div>
			<form method="post">
			<?php if (Auth::get('group') == 2): ?>
				<button type="submit" name="skip" value="true" class="btn btn-success">skip</button>
			<?php endif; ?>
				<button type="submit" name="cancel" value="true" class="btn btn-danger">cancel</button>
			</form>
		</div>
	<?php else: ?>
	<div class="col-md-3 servers">
		<?php if (isset($mission['connected'])): ?>
			<div class="server">
				connected to <?php echo $server['hostname']; ?> : <?php echo $service['port']; ?>
			</div>
			<form method="post">
				<button type="submit" class="btn btn-default" name="service_action" value="disconnect">disconnect</button>
			</form>
		<?php else: ?>

			<div class="list-group">
 
			<?php foreach($mission['servers'] as $server_id => $s): ?>
				<?php if ($s['discovered']): ?>
					<div class="modal fade" id="serverModal_<?php echo $server_id; ?>" role="dialog">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel"><?php echo $s['hostname']; ?></h4>
					      </div>
					      <div class="modal-body">
					      	available services on server
					      	<?php foreach($mission['services'] as $service_id => $service):  ?>
					      		<?php if ($service['quest_server_id'] == $server_id && $service['discovered']): $type = Config::get('service_types')[$service['type']]; ?>
					      			<div class="service">
					      				<i class="fa fa-<?php echo $type['icon']; ?>"></i>  <?php echo $service['port']; ?>: <?php echo $type['name']; ?>
					      				<form method="post" class="text-center">
					        				<input type="hidden" name="service_action" value="<?php echo $service_id; ?>"/>

					        				<select name="username" class="form-control">
					        				<?php foreach($service['users'] as $u => $user): print_r($user);?>

					        					<option value="<?php echo $u; ?>"><?php echo $u; ?> <?php echo !$user['security'] ? 'cracked' : ''; ?></option>
					        				<?php endforeach;?>
					        				</select>

					        				<input type="text" name="password" placeholder="Password" class="form-control" />
				      						<button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
				      						<button type="submit" class="btn btn-default" name="action" value="connect">connect</button>
					      				</form>
					      			</div>
					      		<?php endif; ?>
					      	<?php endforeach; ?>
					        <form method="post" class="text-center">
					        	<input type="hidden" name="server_action" value="<?php echo $server_id; ?>"/>
					        	<button type="submit" class="btn btn-default" name="action" value="scan">nmap for services</button>
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
					      </div>
					    </div>
					  </div>
					</div>
					<a data-toggle="modal" data-target="#serverModal_<?php echo $server_id; ?>" class="list-group-item"><?php echo $s['hostname']; ?></a>

				<?php endif; ?>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="col-md-9">
		<?php if (isset($mission['connected'])): ?>
			<p>
			<?php echo $service['welcome']; ?>
			</p>
			<?php echo View::forge('quests/quests_service_' . $service['type'], array('mission' => $mission, 'service' => $service)); ?>
		<?php else: ?>

		<?php endif; ?>
	</div>
<?php endif; ?>
</div>
<div class="row">
	<div class="col-md-12">
	<div class="container">
	<?php echo html_entity_decode(nl2br($mission['objective']['story'])); ?>
	</div>
	</div>
</div>
<?php echo View::forge('global/footer'); ?>