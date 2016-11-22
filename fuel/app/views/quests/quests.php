<?php echo View::forge('global/header'); ?>

<div class="container">


<?php foreach($groups as $g): ?>
	<div class="mission" style="padding:20px;     border: 1px solid #0d3858;     border-top-width: 5px;
    border-left-width: 5px;margin-bottom:20px; border-top-left-radius:10px; border-bottom-left-radius:40px;">
		<a href="<?php echo Uri::create('quests/group/' . $g['quest_group_id']);?>"><?php echo $g['name']; ?></a>
	</div>
<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>