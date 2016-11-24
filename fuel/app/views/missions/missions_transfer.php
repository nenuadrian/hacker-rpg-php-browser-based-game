<form method="post" class="text-center">
  <input type="hidden" name="transfer" value="<?php echo $user['user_id']; ?>" />
  <?php if ($user['security'] || $user['password']): ?>
  <input type="password" class="form-control" name="password" <?php echo $user['password'] ? 'required' : ''; ?>/>
  <?php else: ?>
    <p>user not protected</p>
  <?php endif; ?>
  <button type="submit" class="btn btn-default" name="action" value="transfer">transfer</button>
</form>
