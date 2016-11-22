<?php echo View::forge('global/header'); ?>

<?php print_r($rankings); ?>
<?php foreach($rankings as $rank): ?>
	<div>
	</div>
<?php endforeach; ?>

<?php print_r($pagination); ?>
<?php echo View::forge('global/footer'); ?>