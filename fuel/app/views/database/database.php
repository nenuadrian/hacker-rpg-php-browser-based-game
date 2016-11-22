<?php echo View::forge('global/header'); ?>


<div class="container">
	<form method="post">
	<div class="row">
	<div class="col-xs-8">
		<input type="text" class="form-control" name="query" placeholder="Keywords.."/>
	</div>
	<div class="col-xs-2">
		<select name="type" class="form-control">
		<option value="hacker">Hackers</option>
		<option value="group">Groups</option>
		</select>
	</div>
	<div class="col-xs-2">
		<button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
	</div>
	</div>
	</form>


</div>


<?php echo View::forge('global/footer'); ?>
