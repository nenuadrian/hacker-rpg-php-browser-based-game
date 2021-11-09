<?php echo View::forge('global/header'); ?>

<div class="container text-center">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <form method="post">
        <p>DB HOSTNAME</p>
        <input type="text" class="form-control" name="HOSTNAME" value="<?=Input::post('HOSTNAME', 'localhost')?>"/>
        <br/>
        <p>DB PORT</p>
        <input type="text" class="form-control" name="PORT" value="<?=Input::post('PORT', '3306')?>"/>
        <br/>
        <p>DB USER</p>
        <input type="text" class="form-control" name="DB_USER" value="<?=Input::post('DB_USER', 'root')?>"/>
        <br/>
        <p>DB PASSWORD</p>
        <input type="text" class="form-control" name="DB_PASS" value="<?=Input::post('DB_PASS')?>"/>
        <br/>
        <p>DB NAME</p>
        <input type="text" class="form-control" name="DATABASE" value="<?=Input::post('DATABASE')?>"/>
        <br/>
        <p>NEW ADMIN USERNAME</p>
        <input type="text" class="form-control" name="ADMIN_USER" value="<?=Input::post('ADMIN_USER')?>"/>
        <br/>
        <p>NEW ADMIN PASSWORD</p>
        <input type="text" class="form-control" name="ADMIN_PASS" value="<?=Input::post('ADMIN_PASS')?>"/>
        <br/>
        <p>NEW ADMIN EMAIL</p>
        <input type="email" class="form-control" name="ADMIN_EMAIL" value="<?=Input::post('ADMIN_EMAIL')?>"/>
        <br/>
        <button class="btn">setup</button>
      </form>
    </div>
  </div>
</div>

<?php echo View::forge('global/footer'); ?>
