<?php use \Model\Hacker;

echo View::forge('global/header'); ?>

  <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6">
	<div class="text-center">
    <h1><a href="<?php echo Uri::create('hacker/access/' . Auth::get('username')); ?>"><?php echo Auth::get('username'); ?></a></h1>
	<h4>LEVEL <?php echo Auth::get('level'); ?></h4><br/>
  <div style="max-width:200px; display:inline-block">
	<?php echo View::forge('components/progress-bar', array(
		'current' => Auth::get('experience') / (Hacker::experience(Auth::get('level') + 1) / 100),
		'type' => 'SemiCircle',
		'text' => Auth::get('experience') . ' / ' . Hacker::experience(Auth::get('level') + 1),
		'id' => 'exp_container'
		)); ?>

</div>
</div>
<br/><br/>
<h3 class="text-right">hackery quote</h3>
<blockquote>
  <?php echo $quote['content']; ?>
  <?php if ($quote['author']): ?>
    <small><?php echo $quote['author']; ?></small>
  <?php endif; ?>
</blockquote>


</div>

<?php echo View::forge('global/footer'); ?>
