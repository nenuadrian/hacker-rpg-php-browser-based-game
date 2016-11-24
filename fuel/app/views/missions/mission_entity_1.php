<?php echo $entity['title'] ;?> <?php echo isset($entity['running']) ? 'running' : ''; ?>



<?php if (!$entity['security']): ?>
	<div class="well">
		<?php if ($entity['content']): ?>
			<div style="white-space:pre;"><?php if ($entity['type'] == 1) echo html_entity_decode(nl2br($entity['content'])); else echo nl2br($entity['content']); ?></div>
		<?php else: ?>
			No human-readable content
		<?php endif; ?>
	</div>
	<?php if ($entity['type'] == 3): ?>
		<?php if (isset($entity['running'])): ?>
			<button type="submit" class="btn btn-default" name="action" value="kill">kill</button>
		<?php else: $can_run = true; ?>
			<?php if ($entity['required_running']): ?>
				<h3>execution requirements</h3>
				<?php foreach($entity['required_running'] as $rr): ?>
					<p><?php echo $mission['entities'][$rr[0]]['title']; ?>

						<?php if(isset($rr[1])): ?>
							on <?php echo $mission['servers'][$mission['services'][$rr[1]]['quest_server_id']]['ip']; ?>:<?php echo $mission['services'][$rr[1]]['port']; ?>
								<?php if (isset($mission['entities'][$rr[0]]['running']) && (!isset($rr[1]) || $mission['entities'][$rr[0]]['service_id'] == $rr[1])): ?>
								  yes
								<?php else: $can_run = false; ?>
								no
								<?php endif; ?>
						<?php endif; ?>
					</p>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if ($can_run): ?>
				<form method="post">
	  			<button type="submit" class="btn btn-default" name="action" value="execute">execute</button>
				</form>
	  		<?php endif; ?>
  		<?php endif ;?>
	<?php endif;?>

	<?php if (!isset($entity['running'])): ?>
			<h3>transfer</h3>
			<?php foreach($mission['users'] as $user_id => $u): if ($user_id == $entity['user_id'] || !$mission['services'][$u['service_id']]['discovered']) continue; ?>
				<?php echo View::forge('components/modal', array('id' => 'user_' . $user_id, 'title' => $u['username'], 'content' => View::forge('missions/missions_transfer', array('user' => $u)))); ?>

				<a data-toggle="modal" href="#user_<?php echo $user_id; ?>">
					<?php echo $u['username']; ?> @ <?php echo $mission['servers'][($service = $mission['services'][$u['service_id']])['quest_server_id']]['ip']; ?>:<?php echo $service['port']; ?>
				</a><br/>
			<?php endforeach ;?>
		<hr/>
	<?php endif ;?>
<form method="post">
	<button type="submit" class="btn btn-default" name="action" value="erase">erase</button>
</form>
<?php else: ?>
	<form method="post">
	<input type="text" name="password" placeholder="Password" class="form-control" />
<button type="submit" class="btn btn-default" name="action" value="password">try pass</button>
or
<button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
</form>
<?php endif; ?>
<hr/>
<form method="post">
<button type="submit" class="btn btn-default" name="action" value="exit">back</button>
</form>
