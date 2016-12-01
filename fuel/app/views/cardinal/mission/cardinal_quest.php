<?php echo View::forge('global/header'); ?>

<?php
	$types = array(
			1 => array(
			'name' => 'Normal'
			),
			2 => array(
			'name' => 'Daily'
			),
		);
?>
	<?php echo View::forge('cardinal/mission/cardinal_quest_menu', array('quest' => $quest)); ?>

	<form method="post" class="well">
		<div class="row">
		<div class="col-xs-1">
		<input type="number" name="quest_group_order" class="form-control" value="<?php echo $quest['quest_group_order']; ?>" />
		</div>
		<div class="col-xs-5">
		<input type="text" name="name" value="<?php echo $quest['name']; ?>" class="form-control" />
		</div>
		<div class="col-xs-3">
		<select name="required_quest_id" class="form-control">
			<option value="0">No parent mission</option>
			<?php foreach($quests as $q): ?>
				<option value="<?php echo $q['quest_id']; ?>" <?php echo $q['quest_id'] == $quest['required_quest_id'] ? 'selected' : ''; ?>><?php echo $q['name']; ?></option>
			<?php endforeach; ?>
		</select>
		</div>
		<div class="col-xs-1">
		<select name="level" class="form-control">
		<?php for ($i = 0; $i <= 100; $i++): ?>
			<option value="<?php echo $i; ?>" <?php echo $quest['level'] == $i ? 'selected' : ''; ?>>L<?php echo $i; ?></option>
		<?php endfor; ?>
			</select>
		</div>
		<div class="col-xs-2">
			<select class="form-control" name="type">
			<?php foreach($types as $type_id => $t): ?>
			<option value="<?php echo $type_id; ?>" <?php echo $type_id == $quest['type'] ? 'selected' : ''; ?>><?php echo $t['name']; ?></option>
			<?php endforeach; ?>
			</select>
		</div>

		<div class="col-xs-4">
			<select name="default_connection" class="form-control">
				<option value="0">No default connection</option>
				<?php foreach($services as $s):
					$users = explode(';', html_entity_decode($s['users'], ENT_QUOTES));
					foreach($users as $u): $u = explode(':', $u); $value = $u[0] . ':' . $s['service_id']; ?>
					<option value="<?php echo htmlspecialchars($value); ?>" <?php echo $value == html_entity_decode($quest['default_connection'], ENT_QUOTES) ? 'selected' : ''; ?>><?php echo $u[0]; ?> : <?php echo $s['hostname']; ?> : <?php echo $s['port']; ?></option>
					<?php endforeach;?>
				<?php endforeach;?>
			</select>
		</div>
		<div class="col-xs-2">
			<select name="one_time_only" class="form-control">
			<option value="0">CAN BE RETRIED</option>
			<option value="1" <?php echo $quest['one_time_only'] ? 'selected' : ''; ?>>ONE ATTEMPT ONLY</option>
			</select>
		</div>
		</div>
		<input type="text" class="form-control" name="summary1" value="<?php echo $quest['summary1']; ?>" />
		<textarea class="form-control" name="summary2"><?php echo $quest['summary2']; ?></textarea>
		<select name="live" class="form-control">
			<option value="0">DRAFT</option>
			<option value="1" <?php echo $quest['live'] ? 'selected' : ''; ?>>LIVE</option>
			</select>
			<div class="row">
				<div class="col-md-4">
						<input type="number" class="form-control" name="money" value="<?php echo $quest['money']; ?>" />
				</div>
				<div class="col-md-4">
						<input type="number" class="form-control" name="experience" value="<?php echo $quest['experience']; ?>" />
				</div>
				<div class="col-md-4">
						<input type="number" class="form-control" name="skill_points" value="<?php echo $quest['skill_points']; ?>" />
				</div>
			</div>
		<button class="btn btn-default btn-block" type="submit">update</button>
	</form>

<?php echo View::forge('global/footer'); ?>
