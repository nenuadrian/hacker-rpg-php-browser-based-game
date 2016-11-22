<?php echo View::forge('global/header'); ?>

<div class="modal fade" id="changeName" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" ><?php echo $server['hostname']; ?></h4>
      </div>
      <div class="modal-body">
        <form method="post" class="text-center">
        	<input type="text" name="name" value="<?php echo $server['hostname']; ?>" class="form-control text-center"/>
        	<button type="submit" class="btn btn-default" >change</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
    </div>
  </div>
</div>

<h1 class="text-center"><?php echo $server['hostname']; ?> <a href="#" data-toggle="modal" data-target="#changeName"><small>change</small></a></h1>
<h3 class="text-center"><?php echo $server['ip']; ?></h3>

<div class="row">
	<div class="col-md-6">
	<h3>ram</h3>
	<?php echo View::forge('components/progress-bar', array('id' => 'ram', 'current' => $server['ram_used'] / ($server['ram'] / 100))); ?>
	
	<br/>
	<h3>cpu</h3>
	<?php echo View::forge('components/progress-bar', array('id' => 'cpu', 'current' => $server['cpu_used'] / ($server['cpu'] / 100))); ?>
	<br/>
	<h3>ssd</h3>
	<?php echo View::forge('components/progress-bar', array('id' => 'ssd', 'current' => $server['ssd_used'] / ($server['ssd'] / 100))); ?>
	

	<?php print_r($server_tasks); ?>
	</div>
	<div class="col-md-6">
		<?php foreach($apps as $k => $app): ?>
			<?php if ($app['owner_id'] == Auth::get('id')): ?>
					<div class="modal fade" id="useApp_<?php echo $k; ?>" role="dialog">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h4 class="modal-title" ><?php echo $app['name']; ?></h4>
					      </div>
					      <div class="modal-body">
					        <form method="post" class="text-center">
					        	<input type="hidden" name="app_action" value="<?php echo $app['server_app_id']; ?>" />
					        	<?php if (isset($app['money_maker_planter'])): ?>
					        		<input type="text" name="target" value="" class="form-control" />
					        		<button type="submit" class="btn btn-default" name="action" value="plant">plan money maker on target</button>
					        	<?php endif; ?>
					        	<?php if (isset($app['money_steal'])): ?>
					        		<input type="text" name="target" value="" class="form-control" />
					        		<button type="submit" class="btn btn-default" name="action" value="steal">steal money from a target</button>
					        	<?php endif; ?>
					        	<?php if (isset($app['grid_scanner'])): ?>
					        		<button type="submit" class="btn btn-default" name="action" value="scan">scan grid for IPs</button>
					        	<?php endif; ?>
					        	<?php if (isset($app['user_run'])): ?>
									<?php if (!isset($app['running'])): ?>
										<button type="submit" name="action" value="start" class="btn btn-default">start</button>
									<?php else: ?>
										<button type="submit" name="action" value="kill" class="btn btn-default">kill</button>
									<?php endif; ?>
								<?php endif; ?>
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
					      </div>
					    </div>
					  </div>
					</div>


					<?php echo $app['name']; ?>
						<a href="#" data-toggle="modal" data-target="#useApp_<?php echo $k; ?>">manage</a>
					
				<hr/>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>

<?php echo View::forge('global/footer'); ?>