<?php 
use \Model\Missions;
use \Model\Servers;

	$commands = Missions::commands();
	$hacks = Servers::hacks();
	

?>
<?php echo $s['description']; ?>

<h3>impact on missions</h3>
<?php foreach($user_skill['influence'] as $in => $value): if (!isset($commands[$in])) continue; ?>
	<p><?php echo $commands[$in]['name']; ?> = <?php echo $value; ?>% (next level: <?php echo $user_skill['influence_next'][$in]; ?>%)</p>
<?php endforeach;?>

<h3>impact on day-2-day hacking</h3>
<?php foreach($user_skill['influence'] as $in => $value): if (!isset($hacks[$in])) continue; ?>
	<p><?php echo $hacks[$in]['name']; ?> = <?php echo $value; ?>% (next level: <?php echo $user_skill['influence_next'][$in]; ?>%)</p>
<?php endforeach;?>