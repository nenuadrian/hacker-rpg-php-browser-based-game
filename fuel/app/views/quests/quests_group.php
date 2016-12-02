<?php echo View::forge('global/header'); ?>
<?php echo Asset::css('missions.css'); ?>

<div class="container">
		<?php foreach($quests as $k => $q): ?>
			<div class="<?php echo $q['available'] ? '' : 'mission-done'; ?>">
    <div class="mission" onclick="$('#mission_<?php echo $k; ?>').collapse('toggle');$('#description_<?php echo $k; ?>').collapse('toggle')">
        <div class="name"><?php echo $q['name']; ?></div>
        <p id="description_<?php echo $k; ?>" class="collapse in">
					<em><?php echo html_entity_decode($q['summary1']); ?></em> -
					<?php echo \Model\Missions::$types[$q['type']]['name']; ?> mission
					<?php if ($q['times']): ?>
						- Completed
						<?php if ($q['type'] != 1): ?>
							<?php if ($q['times'] == 1): ?>
								one time
							<?php else: ?>
								<?php echo $q['times']; ?> times
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
					<?php if (isset($q['available_in'])): ?>
						Repeatable in <?php echo number_format($q['available_in']); ?> seconds
					<?php endif; ?>
				</p>

    </div>

		<div class="collapse mission-content" id="mission_<?php echo $k; ?>">
		  <div class="text-center">
				<p c><small>
				 <?php echo Date::forge($q['duration'])->format("%H:%M:%S"); ?>	-
					<i class="fa fa-cube"></i> <?php echo number_format($q['money']); ?> - <?php echo number_format($q['skill_points']); ?> skill points - <?php echo number_format($q['experience']); ?> exp
				</small></p><br/>
		    <p><?php echo html_entity_decode($q['summary2']); ?></p>
				<?php if ($q['available']): ?>
					<br/>
			    <form method="post">
			      <a href="<?php echo Uri::create('quests/play/' . $q['quest_id']);?>" class="btn">accept mission</a>
			    </form>
				<?php endif; ?>
				<?php if (isset($q['available_in'])): ?>
					<strong>Repeatable in <?php echo number_format($q['available_in']); ?> seconds</strong>
				<?php endif; ?>
		  </div>
		</div>
	</div>
		<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>
