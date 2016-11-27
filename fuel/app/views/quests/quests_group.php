<?php echo View::forge('global/header'); ?>
<?php echo Asset::css('missions.css'); ?>

<div class="container">
		<?php foreach($quests as $q): ?>
    <div class="mission" onclick="$('#mission').collapse('toggle');$('#description').collapse('toggle')">
        <div class="name"><?php echo $q['name']; ?></div>
        <p id="description" class="collapse in"><?php echo html_entity_decode($q['summary1']); ?></p>
    </div>

		<div class="collapse mission-content" id="mission">
		  <div class="text-center">
		    <p><?php echo html_entity_decode($q['summary2']); ?></p><br/>
		    <form method="post" class="text-center">
		      <a href="<?php echo Uri::create('quests/play/' . $q['quest_id']);?>" class="btn">accept mission</a>
		    </form>
		  </div>
		</div>
		<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>
