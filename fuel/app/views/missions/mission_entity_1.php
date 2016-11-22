<?php echo $entity['title'] ;?> <?php echo isset($entity['running']) ? 'running' : ''; ?>

<form method="post">

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
	  			<button type="submit" class="btn btn-default" name="action" value="execute">execute</button>
	  		<?php endif; ?>
  		<?php endif ;?>
	<?php endif;?>

	<?php if (!isset($entity['running'])): ?>
		<h3>transfer</h3>
		<select name="transfer" class="form-control">
		<?php foreach($mission['services'] as $id => $s):?>
			<?php if ($s['discovered'] && $s['type'] == 1): ?>
				<?php foreach($s['users'] as $u_id => $user): ?>
					<?php if ($id != $entity['service_id'] || $u_id != $mission['connected']['username']): ?>
						<option value="<?php echo $u_id . ':' . $id; ?>">
							<?php if (!$user['security']): ?>
								<?php echo $u_id; ?>@<?php echo $mission['servers'][$s['quest_server_id']]['ip']; ?>:<?php echo $s['port']; ?> - cracked - no password required
							<?php else: ?>
								<?php echo $u_id; ?>@<?php echo $mission['servers'][$s['quest_server_id']]['ip']; ?>:<?php echo $s['port']; ?>
							<?php endif; ?>
						</option>
					<?php endif ;?>
				<?php endforeach ;?>
			<?php endif; ?>
		<?php endforeach; ?>
		</select>
		<input type="text" name="password" placeholder="Password (if needed)" class="form-control" />
		<button type="submit" class="btn btn-default" name="action" value="transfer">transfer</button>
		<hr/>
	<?php endif ;?>

	<button type="submit" class="btn btn-default" name="action" value="erase">erase</button>
<?php else: ?>
	<input type="text" name="password" placeholder="Password" class="form-control" />
<button type="submit" class="btn btn-default" name="action" value="password">try pass</button> 
or 
<button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
<?php endif; ?>
<hr/>
<button type="submit" class="btn btn-default" name="action" value="exit">back</button>
</form>