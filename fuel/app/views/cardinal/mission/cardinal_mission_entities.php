<?php foreach($entities as $entity_id => $e): if ($e['user_id'] != $user_id) continue; ?>
  <button id="anchor_entity_<?php echo $entity_id; ?>" class="btn btn-default btn-block" data-toggle="collapse" data-target="#entity_<?php echo $entity_id; ?>">
      <?php echo $e['title']; ?> | S<?php echo $e['security']; ?> | <?php echo $entity_id; ?>
  </button>
  <div class="collapse well <?php echo in_array($entity_id, $expanded['entity']) ? 'in' : ''; ?>" id="entity_<?php echo $entity_id; ?>" >
    <form method="post" action="#anchor_entity_<?php echo $entity_id; ?>">
    <input type="hidden" name="entity_id" value="<?php echo $entity_id; ?>" />

    <div class="row">
      <div class="col-xs-4">
      <input type="text" name="title" class="form-control" value="<?php echo $e['title']; ?>" placeholder="Name/Subject"/>
      </div>
      <div class="col-xs-1">
      <input type="number" name="security" class="form-control" value="<?php echo $e['security']; ?>" placeholder="Security" />
      </div>
      <div class="col-xs-2">
      <input type="number" name="password" class="form-control" value="<?php echo $e['password']; ?>" placeholder="Password" />
      </div>
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
      <?php if (isset($type['sub_entities'])): ?>
        <button class="btn btn-default" type="submit" name="add_entity" value="true">add sub-entity</button>
      <?php endif; ?>
      <button class="btn btn-danger" type="submit" name="delete" value="true">erase</button>
      </div>
      </form>
    <?php if (isset($type['sub_entities'])): ?>
    <h5>sub-entities</h5>
    <div style="padding:20px">
    <?php foreach($entities as $eenity_id => $ee): if ($ee['parent_entity_id'] != $entity_id) continue; ?>
      <form method="post" action="#anchor_entity_<?php echo $eenity_id; ?>" id="anchor_entity_<?php echo $eenity_id; ?>">
      <input type="hidden" name="entity_id" value="<?php echo $ee['entity_id']; ?>" />
        <input type="text" name="title" class="form-control" value="<?php echo $ee['title']; ?>" placeholder="Name/Subject"/>
        <div class="text-center">
        <button class="btn btn-default " type="submit">update</button>
        <button class="btn btn-danger" type="submit" name="delete" value="true">erase</button>
        </div>
        </form>

    <?php endforeach; ?>

    </div>
    <?php endif; ?>
  </div>
<?php endforeach; ?>
