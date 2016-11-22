<?php echo View::forge('global/header'); ?>

<div class="container">
<?php foreach($shop as $item): ?>
	<h2><?php echo $item['app']['name']; ?></h2>
	<h4><i class="fa fa-cube"></i> <?php echo number_format($item['price']); ?></h4>
	<a href="<?php echo Uri::create('shop/buy/' . $item['item_id']); ?>">buy</a>
		<?php print_R($item); ?>

<?php endforeach; ?>
</div>
<?php echo View::forge('global/footer'); ?>