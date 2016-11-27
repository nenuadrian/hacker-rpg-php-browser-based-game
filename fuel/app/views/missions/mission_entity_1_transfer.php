<?php foreach($mission['users'] as $user_id => $u): if ($user_id == $entity['user_id'] || !$mission['services'][$u['service_id']]['discovered']) continue; ?>
  <?php echo View::forge('components/modal', array('id' => 'user_' . $user_id, 'title' => $u['username'], 'content' => View::forge('missions/missions_transfer', array('user' => $u)))); ?>

  <a data-toggle="modal" href="#user_<?php echo $user_id; ?>">
    <?php echo $u['username']; ?> @ <?php $service = $mission['services'][$u['service_id']]; echo $mission['servers'][$service['quest_server_id']]['ip']; ?>:<?php echo $service['port']; ?>
  </a><br/>
<?php endforeach ;?>
