<?php echo View::forge('global/header'); ?>

<div class="container">


<?php foreach($groups as $g): ?>
	<div class="mission" style="padding:20px;  border:1px solid rgba(29, 132, 212, 0.77); cursor:pointer;" onclick="document.location='<?php echo Uri::create('quests/group/' . $g['quest_group_id']);?>'">
		<a href="<?php echo Uri::create('quests/group/' . $g['quest_group_id']);?>"><?php echo $g['name']; ?></a>
	</div>
<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>
