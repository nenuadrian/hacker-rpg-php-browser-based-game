<?php echo View::forge('global/header'); ?>

<h1 class="text-center">
	<?php echo $group['name']; ?>
</h1>
<h3 class="text-center">
Ranked <?php echo $group['ranking']; ?> with <?php echo $group['ranking_points']; ?> points
</h3>

<?php echo View::forge('global/footer'); ?>