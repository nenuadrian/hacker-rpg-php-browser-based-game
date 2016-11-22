<?php foreach (Messages::get('error') as $msg): ?>
 	 <div class="alert alert-danger"><?php echo $msg->message; ?></div>
<?php endforeach; ?>