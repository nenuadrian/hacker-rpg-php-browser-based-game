<?php
use \Model\Knowledge;
 echo View::forge('global/header'); ?>

<?php echo Asset::css('knowledge.css'); ?>

<div class="container">
  <?php foreach($knowledge as $k_id => $k): ?>
    <?php echo View::forge('components/modal', array('id' => 'know-' . $k_id, 'title' => $k['name'], 'content' => View::forge('knowledge/knowledge_modal', 
      array('k' => $k, 'k_id' => $k_id, 'u_k' => $user_knowledge[$k_id])))); ?>


<?php endforeach; ?>

<ul id="categories" class="clr">
  <li class="pusher"></li>

  <?php foreach($knowledge as $k_id => $k): ?>

	<li>
    <div style="cursor:pointer" onclick="$('#know-<?php echo $k_id; ?>').modal({});">
      <?php echo Asset::img('knowledge/knowledge_' . $k_id .'.png'); ?>
        <h3><?php echo $k['name']; ?></h3>
        <p>level <?php echo $user_knowledge[$k_id]['level']; ?></p>
    </div>
  </li>

<?php endforeach; ?>

	

  </ul>


</div>


<?php echo View::forge('global/footer'); ?>