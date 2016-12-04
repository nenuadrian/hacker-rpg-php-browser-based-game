<?php foreach (Messages::get('error') as $msg): ?>
 	 <div class="alert alert-danger"><?php echo $msg->message; ?></div>
<?php endforeach; ?>
<?php foreach (Messages::get('success') as $msg): ?>
 	 <div class="alert alert-success"><?php echo $msg->message; ?></div>
<?php endforeach; ?>
