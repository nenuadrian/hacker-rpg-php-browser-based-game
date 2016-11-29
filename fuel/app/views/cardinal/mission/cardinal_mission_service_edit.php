<form method="post" action="#anchor_service_<?php echo $service_id; ?>">
	<input type="hidden" name="service_id" value="<?php echo $service_id; ?>" />

<input type="number" name="port" class="form-control" value="<?php echo $service['port']; ?>" />
<select name="required_objective" class="form-control">
<option value="0">No required objective</option>
<?php foreach($objectives as $o_id => $o):?>
	<option value="<?php echo $o_id; ?>" <?php echo $o_id == $service['required_objective'] ? 'selected' : ''; ?>><?php echo $o_id; ?> | <?php echo $o['name']; ?></option>
<?php endforeach; ?>
</select>
<select class="form-control" name="type">
<?php foreach(\Model\Missions::$service_types as $t => $tt): ?>
	<option value="<?php echo $t; ?>" <?php echo $service['type'] == $t ? 'selected' : '' ;?>><?php echo $tt['name']; ?></option>
<?php endforeach; ?>
</select>
	<select class="form-control" name="discovered">
		<option value="0">Undiscovered</option>
		<option value="1" <?php echo $service['discovered'] ? 'selected' : ''; ?>>Discovered</option>
		</select>
<textarea class="form-control" name="welcome" placeholder="Welcome message"><?php echo $service['welcome']; ?></textarea>
<div class="text-center">
<button class="btn btn-default " type="submit">update</button>
<button class="btn btn-default" type="submit" name="add_user" value="true">add user</button>
<button class="btn btn-danger" type="submit" name="delete" value="true">erase</button>
</div>
</form>
