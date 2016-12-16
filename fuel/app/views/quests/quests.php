<?php echo View::forge('global/header'); ?>
<?php echo Asset::css('box-layout.css'); ?>


<div class="container">
	<div class="alert alert-warning text-center">
		<p>Only the Computer Science set is currently live. Let us know what you think and we'll make more available.</p>
		We will let you know when new content becomes available!
	</div>
	<div class="row">
		<?php foreach($groups as $g): ?>
			<div class="col-md-6 ">
	        <div class="box-layout">
	            <a class="box-layout-icon ">
	                <div class="front-content">
	                    <h3><?php echo $g['name']; ?></h3>
											<p>level <?php echo $g['level']; ?></p>
	                </div>
	            </a>
	            <a class="box-layout-content" href="<?php echo Uri::create('quests/group/' . $g['quest_group_id']);?>">
	                <h3><?php echo $g['name']; ?></h3>
	                <p><?php echo $g['description']; ?></p>
	            </a>
	        </div>
	    </div>
		<?php endforeach; ?>
	</div>
</div>
<?php echo View::forge('global/footer'); ?>
