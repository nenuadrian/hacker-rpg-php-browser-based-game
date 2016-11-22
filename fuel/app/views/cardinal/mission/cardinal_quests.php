<?php echo View::forge('global/header'); ?>


<div class="container">
<form method="post" class="text-center">
<button class="btn btn-default" type="submit" name="add_group" value="true">add group</button>
</form>
	<?php foreach($groups as $g): ?>

		<h1><a data-toggle="modal" data-target="#group-<?php echo $g['quest_group_id']; ?>">
			<?php echo $g['type']; ?> | <?php echo $g['name']; ?> | <?php echo $g['quest_group_id']; ?>
		</a></h1>

		<?php echo View::forge('components/modal', array('id' => 'group-' . $g['quest_group_id'], 'title' => $g['name'], 'content' => 
		View::forge('cardinal/mission/cardinal_mission_group_form', array('g' => $g, 'quests' => $quests)))); ?>

		<div class="well" id="group_<?php echo $g['quest_group_id']; ?>">
			
			<?php foreach($quests as $q): ?>
				<?php if ($q['quest_group_id'] == $g['quest_group_id']): ?>
					<h4><a href="<?php echo Uri::create('cardinal/quest/' . $q['quest_id']); ?>"><?php echo $q['quest_group_order']; ?> | <?php echo $q['name']; ?> | <?php echo $q['quest_id']; ?> </a></h4>
				<?php endif;?>
			<?php endforeach; ?>
		</div><br/>
	<?php endforeach; ?>
</div>

<?php echo View::forge('global/footer'); ?>
