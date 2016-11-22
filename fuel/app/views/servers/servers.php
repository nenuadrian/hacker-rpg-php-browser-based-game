<?php echo View::forge('global/header'); ?>
<div class="container">
<div class="row">
	<?php foreach($servers as $server): ?>
		<div class="col-md-6">
		<div class="well" style="border-radius:60px">
		<a href="<?php echo Uri::create('servers/server/' . $server['server_id']); ?>" >
	
		 		<?php echo $server['hostname']; ?> - <?php echo $server['ip']; ?>
				</a>
		 		
			</div>
			
		</div>
	<?php endforeach; ?>
</div>
<a href="<?php echo Uri::create('servers/new'); ?>">new</a>

</div>
<?php echo View::forge('global/footer'); ?>