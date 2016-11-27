<?php
use \Model\Missions;
use \Model\Servers;

	$commands = Missions::commands();


?>
<p>
<?php echo $s['description']; ?>
</p>




<h3>impact on day-2-day hacking</h3>
<?php foreach($user_skill['influence'] as $in => $value): if (!isset($commands[$in])) continue; ?>
	<p><?php echo $commands[$in]['name']; ?> = <?php echo $value; ?>% (next level: <?php echo $user_skill['influence_next'][$in]; ?>%)</p>
<?php endforeach;?>

<br/>
<?php if (Auth::get('skill_points')): ?>
<form method="post">
	<div class="row">
		<div class="col-xs-8">
				<input type="number" min="1" max="<?php echo Auth::get('skill_points'); ?>" name="points" class="form-control text-center" value="1" required />
		</div>
		<div class="col-xs-4">
			<button type="submit" name="add_points" value="<?php echo $skill_id; ?>" class="btn btn-default">add</button>
		</div>
	</div>
</form>
<?php else: ?>

	<p class="text-center">No skill points available</p>
<?php endif; ?>
