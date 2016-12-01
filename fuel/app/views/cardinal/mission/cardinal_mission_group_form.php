<form method="post" class="text-center" action="#group_<?php echo $g['quest_group_id']; ?>">
<div class="row">
<div class="col-md-6">
<input type="text" name="type" class="form-control" value="<?php echo $g['type']; ?>" placeholder="Type"/>
</div>
<div class="col-md-6">
<input type="text" name="group_order" class="form-control" value="<?php echo $g['group_order']; ?>" />
</div>
<div class="col-md-6">
<input type="text" name="name" class="form-control" value="<?php echo $g['name']; ?>" />
</div>
<div class="col-md-3">
<select name="level" class="form-control">
<?php for ($i = 0; $i <= 50; $i++): ?>
	<option value="<?php echo $i; ?>" <?php echo $g['level'] == $i ? 'selected' : ''; ?>>L<?php echo $i; ?></option>
<?php endfor; ?>
</select>
</div>
<div class="col-md-3">
	<select name="required_quest_id" class="form-control">
		<option value="0">NONE</option>
		<?php foreach($quests as $q): ?>
			<option value="<?php echo $q['quest_id']; ?>" <?php echo $q['quest_id'] == $g['required_quest_id'] ? 'selected' : ''; ?>><?php echo $q['name']; ?></option>
		<?php endforeach; ?>
	</select>
</div>


</div>
<select name="live" class="form-control">
<option value="0">DRAFT</option>
<option value="1" <?php echo $g['live'] ? 'selected' : ''; ?>>LIVE</option>
</select>
<textarea name="description" class="form-control"><?php echo $g['description']; ?></textarea>
<button class="btn btn-default" type="submit" name="quest_group_id" value="<?php echo $g['quest_group_id']; ?>">update</button>
<button class="btn btn-default" type="submit" name="add_quest" value="<?php echo $g['quest_group_id']; ?>">add</button>

</form>
