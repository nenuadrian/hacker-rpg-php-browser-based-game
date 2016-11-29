<?php echo View::forge('global/header'); ?>

<h2 class="text-center"><?php echo $conv['title']; ?></h2><br/>
<div class="container">

<?php foreach ($replies as $reply): ?>
	<div class="well well-dark">
		<p><?php echo html_entity_decode($reply['message']); ?></p>
		<div class="text-right">
		<small><?php echo $reply['created_at']; ?></small>
	</div>
	</div>
<?php endforeach; ?>
</div>

<a data-toggle="modal" href="#reply" style="    padding: 15px; padding-right: 30px;position:fixed;     bottom: 115px; z-index:500; right: 0;font-size:30px"><i class="fa fa-pencil"></i></a>
<?php echo View::forge('components/modal', array('id' => 'reply', 'title' => 'Reply', 'content' => '<form method="post" class="text-center">
<textarea class="form-control" name="message"></textarea>
<button type="submit" class="btn btn-default">send</button>
</form>')); ?>

<?php echo View::forge('global/footer'); ?>
