<?php use \Model\Train; ?>
<?php echo View::forge('global/header'); ?>


<h1 class="text-center">
  <?php echo $reward['title']; ?>
</h1>
<br/><br/>
<div class="container">
  <div class="row text-center">
  <?php if ($reward['money']): ?>
    <div class="col-md-4">
      <h1 class="text-center"><i class="fa fa-cube"></i></h1>
      <h2><?php echo number_format($reward['money']); ?></h2>
    </div>
  <?php endif; ?>
  <?php if ($reward['skill_points']): ?>
    <div class="col-md-4">
      <h1 class="text-center">skill points</h1>
      <h2><?php echo number_format($reward['skill_points']); ?></h2>
    </div>
  <?php endif; ?>
  <?php if ($reward['experience']): ?>
    <div class="col-md-4">
      <h1 class="text-center">exp</h1>
      <h2><?php echo number_format($reward['experience']); ?></h2>
    </div>
  <?php endif; ?>
  <?php if ($reward['train_id']): ?>
    <div class="col-md-4">
      <h1 class="text-center">Train: <?php echo Train::types()[$reward['train_id']]["name"]; ?> exp</h1>
      <h2><?php echo number_format($reward['train_experience']); ?></h2>
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
