<?php if ($service['type'] == 3) return; ?>
<?php foreach($entities as $entity_id => $e): if ($e['user_id'] != $user_id) continue; $type = Config::get('service_types')[$service['type']]; ?>

  <div class="box-layout" id="anchor_entity_<?php echo $entity_id; ?>" >
		<div class="box-layout-success">
			<a class="box-layout-icon " data-toggle="collapse" data-target="#entity_<?php echo $entity_id; ?>">
					<div class="front-content">
							<h3><?php echo $e['title']; ?> | S<?php echo $e['security']; ?></h3>
					</div>
			</a>
			<a class="box-layout-content" data-toggle="collapse" data-target="#entity_<?php echo $entity_id; ?>">
					<h3>ID(<?php echo $entity_id; ?>)</h3>
					<p></p>
			</a>
		</div>
	</div>

  <div class="collapse <?php echo $entity_id == $expanded['entity'] ? 'in' : ''; ?>" id="entity_<?php echo $entity_id; ?>" >
    <div style="padding:20px">
    <form method="post" action="#anchor_entity_<?php echo $entity_id; ?>" class="well">
      <input type="hidden" name="entity_id" value="<?php echo $entity_id; ?>" />
      <div class="row">
        <div class="col-xs-4">
        <input type="text" name="title" class="form-control" value="<?php echo $e['title']; ?>" placeholder="Name/Subject"/>
        </div>
        <div class="col-xs-1">
        <input type="number" name="security" class="form-control" value="<?php echo $e['security']; ?>" placeholder="Security" />
        </div>
        <?php if ($service['type'] == 1): ?>
          <div class="col-xs-2">
          <input type="number" name="password" class="form-control" value="<?php echo $e['password']; ?>" placeholder="Password" />
          </div>
        <?php endif; ?>
        <div class="col-xs-3">
        <select name="required_objective" class="form-control">
        <option value="0">No required objective</option>
        <?php foreach($objectives as $o_id => $o):?>
          <option value="<?php echo $o_id; ?>" <?php echo $o_id == $e['required_objective'] ? 'selected' : ''; ?><?php echo $o_id; ?> | ><?php echo $o['name']; ?></option>
        <?php endforeach; ?>
        </select>
        </div>
        <?php if ($service['type'] == 2): ?>
          <div class="col-xs-2">
            <input type="text" name="sender_receiver" class="form-control" value="<?php echo $e['sender_receiver']; ?>" placeholder="Sender/Receiver"/>
            </div>
        <?php endif; ?>
        <?php if ($service['type'] == 1): ?>
          <div class="col-xs-2">
          <select class="form-control" name="type">
          <option value="1">Text</option>
          <option value="2" <?php echo $e['type'] == 2 ? 'selected' : ''; ?>>Code</option>
          <option value="3" <?php echo $e['type'] == 3 ? 'selected' : ''; ?>>Executable</option>
          </select>
          </div>
        <?php elseif ($service['type'] == 2): ?>
          <div class="col-xs-2">
          <select class="form-control" name="type">
          <option value="1">Received</option>
          <option value="2" <?php echo $e['type'] == 2 ? 'selected' : ''; ?>>Sent</option>
          </select>
          </div>
        <?php endif; ?>
        <?php if ($service['type'] == 1): ?>
          <?php if ($e['type'] == 3): ?>
            <div class="col-xs-4">
              <input type="text" name="required_running" class="form-control" value="<?php echo $e['required_running']; ?>" placeholder="Required running e(:s)[,..]"/>
            </div>


          <?php endif; ?>
        <?php endif; ?>
      </div>
        <textarea class="form-control" name="content"><?php echo $e['content']; ?></textarea>

        <div class="text-center">
        <button class="btn btn-default " type="submit">update</button>
        <button class="btn btn-danger" type="submit" name="delete" value="true">erase</button>
        </div>
      </form>
  </div>
</div>
<?php endforeach; ?>
