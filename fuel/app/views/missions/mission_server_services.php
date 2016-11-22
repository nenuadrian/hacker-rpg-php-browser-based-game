	

	<?php foreach($services as $service_id => $service):  ?>
		<?php if ($service['quest_server_id'] != $server_id || !$service['discovered'] || isset($service['required_objective'])) continue;
		  $type = Config::get('service_types')[$service['type']]; ?>
			
			<div><a class="btn btn-default" data-toggle="collapse" href="#service-<?php echo $service_id; ?>" >
				<i class="fa fa-<?php echo $type['icon']; ?>"></i> <?php echo $type['name']; ?> | PORT <?php echo $service['port']; ?>
				</a>
			<div class="collapse well" id="service-<?php echo $service_id; ?>">	
				<form method="post" class="text-center">
				<input type="hidden" name="service_action" value="<?php echo $service_id; ?>"/>

				<select name="username" class="form-control">
				<?php $not_cracked_found = false; foreach($service['users'] as $u => $user): ?>
					<option value="<?php echo $u; ?>">
					<?php if (!$user['security']): ?>
						<?php echo $u; ?> - cracked - no password required
					<?php else: $not_cracked_found = true; ?>
						<?php echo $u; ?>
					<?php endif; ?>
					</option>
				<?php endforeach;?>
				</select>
					<input name="password" type="<?php echo $not_cracked_found ? 'text' : 'hidden'; ?>" placeholder="Password (if needed)" class="form-control" />
					<button type="submit" class="btn btn-default" name="action" value="connect">connect</button>
					<?php if ($not_cracked_found): ?>
					<button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
					<?php endif; ?>
				</form>
			</div></div>
	<?php endforeach; ?>


<form method="post" class="text-center">
	<input type="hidden" name="server_action" value="<?php echo $server_id; ?>"/>
	<button type="submit" class="btn btn-default" name="action" value="scan">nmap for services</button>
</form>

<hr/>
<form method="post" class="text-center">
	<input type="hidden" name="server_action" value="<?php echo $server_id; ?>"/>
	<input name="custom_name" value="<?php echo isset($s['custom_name']) ? $s['custom_name'] : ''; ?>" placeholder="Custom name" class="form-control" />
	<button type="submit" class="btn btn-default" name="action" value="set_name">set name</button>
</form>