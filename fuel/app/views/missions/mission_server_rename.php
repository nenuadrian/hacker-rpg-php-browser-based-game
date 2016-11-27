<form method="post" class="text-center">
  <input type="hidden" name="server_action" value="<?php echo $server_id; ?>"/>
  <input name="custom_name" value="<?php echo isset($s['custom_name']) ? $s['custom_name'] : ''; ?>" placeholder="Custom name" class="form-control" />
  <button type="submit" class="btn btn-default" name="action" value="set_name">set name</button>
</form>
