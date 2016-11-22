<?php echo View::forge('global/header'); ?>

<?php echo Asset::css('worldTimeline.css'); ?>

  <p class="text-center">
  The world reset in late 2016. The previous version of the competition ran from 2012 to 2016 with 13k participants.
  </p>
  <section id="timeline">

    <div class="timeline">
        <canvas id="cvs3" width="1280" height="1029"></canvas> 
        <article> 
        	<?php foreach($leftSide as $item): ?>
             <figure> 
                <figcaption><?php echo number_format($item['value']); ?></figcaption>
                <h6><?php echo $item['title']; ?></h6>
                <p><?php echo $item['description']; ?></p>
            </figure>
            <?php endforeach;?>
            
        </article>

        <article>
            <?php foreach($rightSide as $item): ?>
             <figure> 
                <figcaption><?php echo number_format($item['value']); ?></figcaption>
                <h6><?php echo $item['title']; ?></h6>
                <p><?php echo $item['description']; ?></p>
            </figure>
            <?php endforeach;?>
           
        </article>
        <br style="clear:both">
    </div>

</section>
<?php echo Asset::js('worldTimeline.js'); ?>


<?php echo View::forge('global/footer'); ?>