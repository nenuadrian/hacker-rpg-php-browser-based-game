<div class="text-center"> <h1>
		<a href="<?php echo Uri::create('cardinal/quest/' . $quest['quest_id']); ?>"> mission </a>
		<a href="<?php echo Uri::create('cardinal/quest_objectives/' . $quest['quest_id']); ?>"> objectives </a>
		<a href="<?php echo Uri::create('cardinal/quest_servers/' . $quest['quest_id']); ?>"> servers </a>
		<a href="<?php echo Uri::create('cardinal/quest_play/' . $quest['quest_id']); ?>"> play </a>
		</h1>
	</div>
	<br/><br/>
	<?php echo Asset::css('box-layout.css'); ?>
<style>
.box-layout-icon, .box-layout-content {
	height: 120px;
}

.box-layout .box-layout-icon .front-content {
	top:45px;
}

</style>
