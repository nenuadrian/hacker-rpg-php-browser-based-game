<?php echo View::forge('global/header'); ?>

<?php echo Asset::css('worldTimeline.css'); ?>

<div class="container">
  <div class="alert alert-info text-center">
    <p>The world state reset in late 2016.</p>
    The previous version of the competition ran from 2012 to 2016 with over 13k participants.
  </div>
    <section id="timeline">

      <div class="timeline">
          <canvas id="cvs3" width="1280" height="1029"></canvas>
          <article>
          	<?php foreach($leftSide as $item): ?>
               <figure>
                  <figcaption><?php echo number_format($item['value']); ?></figcaption>
                  <h6><?php echo html_entity_decode($item['title']); ?></h6>
                  <p><?php echo $item['description']; ?></p>
              </figure>
              <?php endforeach;?>

          </article>

          <article>
              <?php foreach($rightSide as $item): ?>
               <figure>
                  <figcaption><?php echo number_format($item['value']); ?></figcaption>
                  <h6><?php echo html_entity_decode($item['title']); ?></h6>
                  <p><?php echo $item['description']; ?></p>
              </figure>
              <?php endforeach;?>

          </article>
          <br style="clear:both">
      </div>

  </section>
  <?php echo GlobalJs::include_js('worldTimeline.js'); ?>
</div>

<?php echo View::forge('global/footer'); ?>
