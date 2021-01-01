<?php echo View::forge('global/header', array('messages_handled' => true)); ?>
<div id="cann" style="position: absolute;
    top: 0!important;
    left: 0!important;
    width: 100%;
    height: 100%;
    overflow: hidden!important;
    z-index: -1!important;
    margin: 0;
    padding: 0;
    position: fixed;
    opacity: 0.3;"> <canvas id="can" class="transparent_class" ></canvas> </div>
    <?php echo GlobalJs::include_js('hackerIntro.js'); ?>

<div class="container">
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6 text-center">
		<img src="<?php echo Uri::create('assets/img/logo.png'); ?>" class="main-logo" style="max-width:300px; width:100%; margin-top:-60px; margin-bottom:20px" />
    <p><a href="https://github.com/nenuadrian/Secret-Republic-Hacker-Game-ORPBG-Alpha" target="_blank">Open Source framework of this game on GitHub</a></p>

    <?php echo !Input::post('register') ? View::forge('components/messages') : ''; ?>
    <br/>
		<form method="post">
      <div class="row">
        <div class="col-sm-6">
			    <input type="text" class="form-control text-center" placeholder="nickname" name="username" autocapitalize="off" autocorrect="off" required maxlength="30" />
			  </div>
        <div class="col-sm-6">
          <input type="password" class="form-control text-center" placeholder="password" name="password"  required  maxlength="30" />
        </div>
      </div>
			<button class="btn btn-block btn-default" type="submit" style="margin-top:20px" name="connect" value="true">connect</button>
      <a class="btn btn-block btn-sm" href="<?php echo Uri::create('welcome/forgot'); ?>">forgot?</a>
		</form>
    <br/><br/>
    <?php echo Input::post('register') ? View::forge('components/messages') : ''; ?>
    <form method="post" id="register" action="#register">
			<div class="row">
				<div class="col-xs-6">
					<input type="text" class="form-control text-center" placeholder="nickname" name="username" required value="<?php echo Input::post('username', ''); ?>" autocapitalize="off" autocorrect="off" maxlength="30" />
				</div>
				<div class="col-xs-6">
					<input type="password" class="form-control text-center" placeholder="password" name="password" required value="<?php echo Input::post('password', ''); ?>" maxlength="30" />
				</div>
			</div>
			<input type="email" class="form-control text-center" placeholder="email (bonus on confirm)" name="email" required value="<?php echo Input::post('email', ''); ?>" autocapitalize="off" autocorrect="off" maxlength="255" />
			<br/>
			<p>
			I fully agree with the <a href="<?php echo Uri::create('pages/view/terms-of-service'); ?>">terms of service</a> && <a href="<?php echo Uri::create('pages/view/privacy-policy'); ?>">privacy policy</a> and would like to
			</p>
			<button class="btn btn-block btn-default" type="submit" style="margin-top:20px" name="register" value="true">obtain citizenship</button>
		</form>
  </div>

</div>
</div>


<?php echo View::forge('global/footer'); ?>
