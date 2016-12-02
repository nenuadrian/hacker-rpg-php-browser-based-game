<?php echo View::forge('global/header'); ?>

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
			<?php foreach(\Model\Missions::$types as $type_id => $t): ?>
			<option value="<?php echo $type_id; ?>" <?php echo $type_id == $quest['type'] ? 'selected' : ''; ?>><?php echo $t['name']; ?></option>
			<?php endforeach; ?>
			</select>
		</div>

		<div class="col-xs-4">
			<select name="default_connection" class="form-control">
				<option value="0">No default connection</option>
				<?php  foreach($users as $u):?>
					<option value="<?php echo $u['user_id']; ?>" <?php echo $quest['default_connection'] == $u['user_id'] ? 'selected' : ''; ?>><?php echo $u['username']; ?></option>
				<?php endforeach;?>
			</select>
		</div>

		</div>
		<textarea class="form-control" name="summary"><?php echo $quest['summary']; ?></textarea>
		<div class="row">
			<div class="col-md-6">
				<input type="number" class="form-control" name="duration" value="<?php echo $quest['duration']; ?>" />
			</div>
			<div class="col-md-6">
		<select name="live" class="form-control">
			<option value="0">DRAFT</option>
			<option value="1" <?php echo $quest['live'] ? 'selected' : ''; ?>>LIVE</option>
			</select>
		</div>
	</div>
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
