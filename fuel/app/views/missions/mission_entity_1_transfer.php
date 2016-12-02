<?php foreach($mission['users'] as $user_id => $u): $service = $mission['services'][$u['service_id']]; $server = $mission['servers'][$service['quest_server_id']];
  if ($user_id == $entity['user_id'] || !$service['discovered'] || !$server['discovered']) continue; $found = true;?>
  <?php echo View::forge('components/modal', array('id' => 'user_' . $user_id, 'title' => $u['username'], 'content' => View::forge('missions/missions_transfer', array('user' => $u)))); ?>
  <a data-toggle="modal" href="#user_<?php echo $user_id; ?>">
    <?php echo $u['username']; ?> @ <?php echo $server['ip']; ?>:<?php echo $service['port']; ?>
  </a><br/>
<?php endforeach ;?>
<?php if (!isset($found)): ?>
  <div class="alert alert-info text-center" style="margin:0;">
    You haven't discovered any other available services.
  </div>
<?php endif; ?>
