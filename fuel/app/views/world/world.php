<?php echo View::forge('global/header'); ?>


<div class="container">
  <div class="alert alert-info text-center">
    <p>The world state reset in late 2016.</p>
    The previous version of the competition ran from 2012 to 2016 with over 13k participants.
  </div>
  <div class="row text-center">
    <?php foreach ($data as $d): ?>
      <div class="col-sm-4">
        <h1><?php echo number_format($d['value']); ?></h1>
        <h3><?php echo html_entity_decode(strtolower($d['title'])); ?></h3>
        <p><?php echo html_entity_decode($d['description']); ?></p>
        <br/>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php echo View::forge('global/footer'); ?>
