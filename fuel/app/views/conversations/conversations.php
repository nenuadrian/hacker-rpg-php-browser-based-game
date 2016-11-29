<?php echo View::forge('global/header'); ?>

<div class="container">
	<div class="text-center">
<a href="<?php echo Uri::create('conversations/new'); ?>" class="btn btn-default">write email</a>
</div>
<br/>
<?php foreach($convs as $c): ?>
	<div class="well">
		<a href="<?php echo Uri::create('conversations/conversation/' . $c['conversation_id']); ?>"><?php echo $c['title']; ?></a><br/>
		<small>conversation w/ <?php echo $op_usernames[$c['op']]; ?></small>
	</div>
<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>
