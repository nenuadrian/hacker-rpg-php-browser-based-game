<form method="post" class="text-center">
  <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>" />
  <?php if ($user['security'] || $user['password']): ?>
  <input type="password" class="form-control" name="password" />
  <?php else: ?>
    <p>user not protected</p>
  <?php endif; ?>
  <button type="submit" class="btn btn-default" name="action" value="connect">connect</button>
  <?php if ($user['security']): ?>
  <button type="submit" class="btn btn-default" name="action" value="crack">crack</button>
  <?php endif; ?>
</form>
