<?php echo View::forge('global/header'); ?>

  <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6">
	<div class="text-center">
    <h1><a href="<?php echo Uri::create('hacker/access/' . Hacker::get('username')); ?>"><?php echo Hacker::get('username'); ?></a></h1>
	<h4>LEVEL <?php echo Hacker::get('level'); ?></h4>
  <h5>ranked #<?php echo number_format(Hacker::get('ranking')); ?></h5><br/><br/>
  <div style="max-width:200px; display:inline-block">
	<?php echo View::forge('components/progress-bar', array(
		'current' => Hacker::get('experience') / (Hacker::experience(Hacker::get('level') + 1) / 100),
		'type' => 'SemiCircle',
		'text' => Hacker::get('experience') . ' / ' . Hacker::experience(Hacker::get('level') + 1),
		'id' => 'exp_container'
		)); ?>

</div>
</div>
<br/><br/>
<?php if (Hacker::check() && !Hacker::email_confirmed()): ?>
  <div class="alert alert-warning">
    Please confirm your email through the link we've sent to your inbox. <a href="<?php echo Uri::create('welcome/resend'); ?>">Resend</a>?
  </div>
<?php endif; ?>
<?php /*if (!Hacker::get('q_answer')): ?>
<div class="alert alert-info text-center">
  Interested in joining the team as a mission designer? <a href="<?php echo Uri::create('dashboard/answer/1'); ?>">yes</a> / <a href="<?php echo Uri::create('dashboard/answer/2'); ?>">no</a><br/>
  <small>0 programming knowledge needed - must finish all CS missions<br/>Use feedback to tell us more about you and your ideas</small>
</div>
<?php endif;*/ ?>
<br/>
<blockquote>
  <?php echo $quote['content']; ?>
  <?php if ($quote['author']): ?>
    <small><?php echo $quote['author']; ?></small>
  <?php endif; ?>
</blockquote>
<div class="text-center">
<a href="<?php echo Uri::create('feedback'); ?>" class="btn btn-default"><i class="fa fa-smile-o" aria-hidden="true"></i> feedback</a>
<a href="<?php echo Uri::create('world'); ?>" class="btn btn-default">world <i class="fa fa-globe" aria-hidden="true"></i></a>
</div><br/>
<div class="alert alert-info text-center">
  We are Alpha <strong>testing</strong>. Send us constructive <strong>feedback</strong> as often as you want!
</div>
<br/>

</div>
</div>
<?php echo View::forge('global/footer'); ?>
