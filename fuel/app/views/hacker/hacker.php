<?php use \Model\Achievements;
echo View::forge('global/header'); ?>
<div class="container">
<h1 class="text-center"><?php echo $hacker['username']; ?></h1>
<h4 class="text-center">LEVEL <?php echo Auth::get('level'); ?></h4>
<h5 class="text-center">ranked #<?php echo number_format(Auth::get('ranking')); ?></h5><br/><br/>

<br/><br/>
<div class="row">
<div class="col-md-6"></div>
<div class="col-md-6">
  <h2 class="text-center">achievements</h2>
<Br/>
<div class="row">
<?php foreach(Achievements::$achievements as $id => $a): if(!isset($hacker['achievements'][$id])) continue; $has = true; ?>
<div class="col-md-3 col-xs-6 text-center ">

<?php echo View::forge('components/modal', array('id' => 'achievement-' . $id, 'title' => $a['name'], 'content' => $a['description'])); ?>

<a style="display:block;" data-toggle="modal" data-target="#achievement-<?php echo $id; ?>">
<h3><?php echo $a['name']; ?></h3>
</br>
<?php echo Asset::img('achievements/achievement_' . $id .'.png', array('style' => 'max-width:100px;')); ?>
</a>
</div>
<?php endforeach; ?>
<?php if (!isset($has)): ?>
  <div class="well text-center">
  <?php echo $hacker['username']; ?> does not have any achievement :(.
</div>
<?php endif; ?>
</div>
</div>
</div>
</div>


<?php echo View::forge('global/footer'); ?>
