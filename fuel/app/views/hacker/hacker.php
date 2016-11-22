<?php use \Model\Achievements;
echo View::forge('global/header'); ?>

<h1 class="text-center"><?php echo $hacker['username']; ?></h1>
<h2 class="text-center">L<?php echo $hacker['level']; ?></h2>

<div class="row">
<div class="col-md-6"></div>
<div class="col-md-6">

<div class="row">
<?php foreach(Achievements::$achievements as $id => $a): ?>
<div class="col-md-3 text-center">

<?php echo View::forge('components/modal', array('id' => 'achievement-' . $id, 'title' => $a['name'], 'content' => $a['description'])); ?>

<a style="display:block; <?php echo !isset($hacker['achievements'][$id]) ? 'opacity:.5' : ''; ?>" data-toggle="modal" data-target="#achievement-<?php echo $id; ?>">
<h3><?php echo $a['name']; ?></h3>
<?php echo Asset::img('achievements/achievement_' . $id .'.png', array('style' => 'max-width:100px;')); ?>
</a>
</div>
<?php endforeach; ?>
</div>
</div>
</div>



<?php echo View::forge('global/footer'); ?>