<?php echo View::forge('global/header'); ?>


<div class="container">
  <Br/><Br/>
  <form method="post">
    <div class="row">
      <div class="col-xs-9">
        <h3>A.I. voice</h3>
      </div>
      <div class="col-xs-3 text-center">
        <button type="submit" class="btn btn-default" name="voice" value="true">
          <?php echo Auth::get('voice_enabled') ? 'enabled' : 'disabled'; ?>
        </button>
      </div>
    </div>
  </form>
</div>

<?php echo View::forge('global/footer'); ?>
