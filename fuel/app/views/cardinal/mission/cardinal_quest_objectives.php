<?php
use \Model\Cardinal;

 echo View::forge('global/header'); ?>

<?php

$objective_expanded = Input::get('objective_id');
if ($objective_expanded) {
	if ($objectives[$objective_expanded]['parent_objective_id']) {
		$objective_expanded = $objectives[$objective_expanded]['parent_objective_id'];
	}
}
?>

<div class="container">
	<?php echo View::forge('cardinal/mission/cardinal_quest_menu', array('quest' => $quest)); ?>

	<form class="text-center" method="post">
	<button type="submit" name="add_objective" value="true" class="btn btn-block">add objective</button>
	</form>
	<?php foreach($objectives as $objective_id => $o): ?>
		<?php if ($o['parent_objective_id']) continue; ?>
		<button class="btn btn-default btn-block" data-toggle="collapse" data-target="#objective_<?php echo $objective_id; ?>">
			O(<?php echo $o['objective_order']; ?>) | <?php echo $o['name']; ?> | ID(<?php echo $objective_id; ?>)
		</button>

		<div class="well well-dark collapse <?php echo $objective_expanded == $objective_id ? 'in' : ''; ?>" id="objective_<?php echo $objective_id; ?>">
		<form method="post" class="text-center" action="#objective_<?php echo $objective_id; ?>">
		<div class="row">
		<div class="col-xs-2">
		<input type="number" name="objective_order" class="form-control" value="<?php echo $o['objective_order']; ?>" />
		</div>
		<div class="col-xs-10">
		<input type="text" name="name" class="form-control" value="<?php echo $o['name']; ?>" placeholder="Name"/>
		</div>
		</div>
		<textarea name="story" class="form-control" placeholder="Story"><?php echo $o['story']; ?></textarea>
		<button class="btn btn-default" type="submit" name="objective_id" value="<?php echo $objective_id; ?>">update</button>
		<button class="btn btn-default" type="submit" name="add_side" value="<?php echo $objective_id; ?>">add side-obj</button>
		<button class="btn btn-danger" type="submit" name="delete" value="<?php echo $objective_id; ?>">erase</button>

		</form>
			<?php foreach($objectives as $side_o):  ?>
				<?php if ($objective_id != $side_o['parent_objective_id']) continue; $side_type = Cardinal::$objective_types[$side_o['type']]; ?>
				<div class="well well-dark" id="objective_<?php echo $side_o['objective_id']; ?>">
				<form method="post" class="text-center" action="#objective_<?php echo $side_o['objective_id']; ?>">
					<div class="row">
					<div class="col-xs-4">
					<select name="type" class="form-control">
						<?php foreach(Cardinal::$objective_types as $t => $type): ?>
							<option value="<?php echo $t; ?>" <?php echo $t == $side_o['type'] ? 'selected' : ''; ?>><?php echo $type['name']; ?></option>
						<?php endforeach; ?>
					</select>
					</div>
						<?php
						$data = explode(':', $side_o['data']);
						$selected_entity = $data[0];
						$selected_user = count($data) == 2 ? $data[1] : $data[0];
						if (in_array($side_type['data_type'], array('entity', 'entity_user'))): ?>
						<div class="col-xs-4">
							<select name="data_entity" class="form-control">
							<option>NONE</option>
							<?php foreach($entities as $e_id => $e): ?>
								<option value="<?php echo $e_id; ?>" <?php echo $e_id == $selected_entity ? 'selected' : ''; ?>><?php echo $e['title']; ?> - <?php echo $e['username']; ?> @ <?php echo $e['hostname']; ?>:<?php echo $e['port']; ?></option>
							<?php endforeach;?>
							</select>
							</div>
						<?php endif; ?>
						<?php if (in_array($side_type['data_type'], array('user', 'entity_user'))): ?>
							<div class="col-xs-4">
							<select name="data_user" class="form-control">
							<option>NONE</option>
							<?php foreach($users as $u_id => $u): ?>
								<option value="<?php echo $u_id; ?>" <?php echo $u_id == $selected_user ? 'selected' : ''; ?>><?php echo $u['username']; ?> @ <?php echo $u['hostname']; ?>:<?php echo $u['port']; ?></option>
							<?php endforeach;?>
							</select>
							</div>
						<?php endif; ?>

					</div>
				<button class="btn btn-default" type="submit" name="objective_id" value="<?php echo $side_o['objective_id']; ?>">update</button>
				<button class="btn btn-danger" type="submit" name="delete" value="<?php echo $side_o['objective_id']; ?>">erase</button>
				</form>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>

<?php echo View::forge('global/footer'); ?>
