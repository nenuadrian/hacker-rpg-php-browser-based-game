<?php echo View::forge('global/header'); ?>
<?php echo Asset::css('missions.css'); ?>

<div class="container">
		<?php if (!$quests): ?>
			<div class="alert alert-info text-center">
				Nothing here
			</div>
		<?php endif; ?>
		<?php foreach($quests as $k => $q):  ?>
			<div class="<?php echo !$q['times'] ? '' : 'mission-done'; ?>">
    <div class="mission" onclick="$('#mission_<?php echo $k; ?>').collapse('toggle');$('#description_<?php echo $k; ?>').collapse('toggle')">
        <div class="name"><?php echo $q['name']; ?></div>
        <p id="description_<?php echo $k; ?>" class="collapse in">
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
				<?php if (!$q['times'] || $q['type'] != 3): ?>
					<p><small>
					 <?php echo Date::forge($q['duration'])->format("%H:%M:%S"); ?>	-
						<i class="fa fa-cube"></i> <?php echo number_format($q['money']); ?> - <?php echo number_format($q['skill_points']); ?> skill points - <?php echo number_format($q['experience']); ?> exp
					</small></p><br/>
				<?php endif; ?>
		    <p><?php echo html_entity_decode($q['summary']); ?></p>
				<?php if ($q['available']): ?>
					<br/>
			    <form method="post">
			      <a href="<?php echo Uri::create('quests/play/' . $q['quest_id']);?>" class="btn">
							<?php if ($q['times']): ?>
								repeat mission
							<?php else: ?>
								accept mission
							<?php endif; ?>
						</a>
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
