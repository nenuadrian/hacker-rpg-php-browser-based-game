<?php echo View::forge('global/header'); ?>

<div class="container">
<a href="<?php echo Uri::create('conversations/new'); ?>"><h2 class="text-center">write email</h2></a>

<?php foreach($convs as $c): ?>
	<a href="<?php echo Uri::create('conversations/conversation/' . $c['conversation_id']); ?>"><?php echo $c['title']; ?></a>
	with <?php echo $op_usernames[$c['op']]; ?>
	<hr/>
<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>