<?php echo View::forge('global/header'); ?>


<div class="container">
  <Br/><Br/>
    <div class="row-fluid">
      <div class="col-xs-9">
        <h3>A.I. voice</h3>
      </div>
      <div class="col-xs-3 text-center">
        <form method="post">
          <button type="submit" class="btn btn-default" name="voice" value="true">
            <?php echo Auth::get('voice_enabled') ? 'enabled' : 'disabled'; ?>
          </button>
        </form>
      </div>
    </div>
</div>

<?php echo View::forge('global/footer'); ?>
