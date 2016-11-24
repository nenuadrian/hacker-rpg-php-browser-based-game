

<?php foreach($users as $user_id => $u): if ($u['service_id'] != $service_id) continue; ?>
  <button id="anchor_user_<?php echo $user_id; ?>" class="btn btn-default btn-block" data-toggle="collapse" data-target="#user_<?php echo $user_id; ?>">
      <?php echo $u['username']; ?> | P<?php echo $u['password']; ?> | S<?php echo $u['security']; ?> | <?php echo $user_id; ?>
  </button>
  <div class="collapse well <?php echo $user_id == $expanded['user'] ? 'in' : ''; ?>" id="user_<?php echo $user_id; ?>" >
    <form method="post" action="#anchor_user_<?php echo $user_id; ?>">
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
      <div class="text-center">
        <button class="btn btn-default " type="submit">update</button>
        <button class="btn btn-default" type="submit" name="add_entity" value="true">add entity</button>
        <button class="btn btn-danger" type="submit" name="delete" value="true">erase</button>
      </div>
    </form>

    <?php echo View::forge('cardinal/mission/cardinal_mission_entities', array('service' => $service, 'entities' => $entities, 'user_id' => $user_id, 'expanded' => $expanded, 'objectives' => $objectives)); ?>

  </div>
<?php endforeach; ?>
