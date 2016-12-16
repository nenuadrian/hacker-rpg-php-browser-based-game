<?php echo View::forge('global/header'); ?>

<div class="container">
  <?php foreach ($feedback as $f): ?>

    <div class="well well-dark">
      <p><?php $m = json_decode(html_entity_decode($f['data']), true); echo htmlentities($m['message']); ?></p>

  		<div class="text-center">
    		<small>
          <a href="<?php echo Uri::create('conversations/new/' . $f['username']); ?>">
            <?php echo $f['username'] ? $f['username'] : 'unknown'; ?>
          </a> - <?php echo $f['created_at']; ?></small>
    	</div>
  	</div>
  <?php endforeach; ?>

  <div class="text-center">
    <?php echo str_replace(array('<div', '<span'), array('<ul', '<li'), html_entity_decode($pagination)); ?>
  </div>
</div>

<?php echo View::forge('global/footer'); ?>
