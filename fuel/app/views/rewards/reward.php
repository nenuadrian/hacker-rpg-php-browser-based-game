<?php use \Model\Train; ?>
<?php echo View::forge('global/header'); ?>


<h1 class="text-center">
  <?php echo $reward['title']; ?>
</h1>
<br/><br/>
<div class="container">
  <div class="row text-center">
  <?php if ($reward['money']): ?>
    <div class="col-xs-4">
      <h3 class="text-center"><i class="fa fa-cube"></i></h3>
      <h4><?php echo number_format($reward['money']); ?></h4>
    </div>
  <?php endif; ?>
  <?php if ($reward['skill_points']): ?>
    <div class="col-xs-4">
      <h3 class="text-center">skill points</h3>
      <h4><?php echo number_format($reward['skill_points']); ?></h4>
    </div>
  <?php endif; ?>
  <?php if ($reward['experience']): ?>
    <div class="col-xs-4">
      <h3 class="text-center">exp</h3>
      <h4><?php echo number_format($reward['experience']); ?></h4>
    </div>
  <?php endif; ?>
  <?php if ($reward['train_id']): ?>
    <div class="col-xs-4">
      <h3 class="text-center">Train: <?php echo Train::types()[$reward['train_id']]["name"]; ?> exp</h3>
      <h4><?php echo number_format($reward['train_experience']); ?></h4>
    </div>
  <?php endif; ?>
  </div>
</br>
<?php print_r($reward); ?>

  <?php if (!$reward['claimed']): ?>
  <form method="post" class="text-center">
      	<button type="submit" class="btn btn-default btn-block btn-lg" name="claim" value="true">claim reward</button>
  </form>
<?php endif; ?>

</div>

<?php echo View::forge('global/footer'); ?>
