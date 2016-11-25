

<?php foreach($users as $user_id => $u): if ($u['service_id'] != $service_id) continue; ?>
  <div class="box-layout" id="anchor_user_<?php echo $user_id; ?>">
		<div class="box-layout-gray">
			<a class="box-layout-icon " data-toggle="collapse" data-target="#user_<?php echo $user_id; ?>">
					<div class="front-content">
							<h3><?php echo $u['username']; ?> | P<?php echo $u['password']; ?> | S<?php echo $u['security']; ?></h3>
					</div>
			</a>
			<a class="box-layout-content" data-toggle="collapse" data-target="#user_<?php echo $user_id; ?>">
					<h3>ID(<?php echo $user_id; ?>)</h3>
					<p></p>
			</a>
		</div>
	</div>
  <div class="collapse <?php echo $user_id == $expanded['user'] ? 'in' : ''; ?>" id="user_<?php echo $user_id; ?>" >
    <div style="padding:20px">
        <form method="post" action="#anchor_user_<?php echo $user_id; ?>" class="well">
          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
          <div class="row">
            <div class="col-xs-4">
            <input type="text" name="username" class="form-control" value="<?php echo $u['username']; ?>" placeholder="Username"/>
            </div>
            <div class="col-xs-4">
            <input type="text" name="password" class="form-control" value="<?php echo $u['password']; ?>" placeholder="Password"/>
            </div>
            <div class="col-xs-4">
            <input type="number" name="security" class="form-control" value="<?php echo $u['security']; ?>" placeholder="Security"/>
            </div>
          </div>
          <?php if ($service['type'] == 3): ?>
            <textarea class="form-control" name="content"><?php echo $u['content']; ?></textarea>
          <?php endif ;?>
          <div class="text-center">
            <button class="btn btn-default " type="submit">update</button>
            <?php if ($service['type'] != 3): ?>
              <button class="btn btn-default" type="submit" name="add_entity" value="true">add entity</button>
            <?php endif; ?>
            <button class="btn btn-danger" type="submit" name="delete" value="true">erase</button>
          </div>
        </form>

      <?php echo View::forge('cardinal/mission/cardinal_mission_entities', array('service' => $service, 'entities' => $entities, 'user_id' => $user_id, 'expanded' => $expanded, 'objectives' => $objectives)); ?>
    </div>
  </div>
<?php endforeach; ?>
