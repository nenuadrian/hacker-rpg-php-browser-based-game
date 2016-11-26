<?php use \Model\Train; ?>
<?php echo View::forge('global/header'); ?>
<?php

$pogress_shapes = array();

?>
<div class="container">

	<div class="row">
		<?php foreach(Train::types() as $train_id => $t): ?>
			<div class="col-md-4 text-center">
<h3><?php echo $t['name']; ?> training</h3><br/>


<?php $shapes = array(0 => 'Square', 1 => 'Circle', 2 => 'Triangle'); ?>
<?php echo View::forge('components/progress-bar', array('type' => $shapes[$train_id %3], 'current' => $train[$train_id]['exp'] / ($train[$train_id]['exp_next'] / 100), 'max_width' => '150px', 'id' => $train_id, 'text' => 'L' . $train[$train_id]['level'])); ?>

<br/>

				<p>
				 <?php echo $train[$train_id]['exp']; ?>/<?php echo $train[$train_id]['exp_next']; ?>
				</p>
				<form method="post">
				<button type="submit" class="btn btn-default" name="train_type" value="<?php echo $train_id; ?>">
					train
				</button>
				</form>
			</div>

		<?php endforeach; ?>

	</div>
</div>

<?php echo View::forge('global/footer'); ?>
