<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<title><?php echo isset($title) ? $title . ' - ' : ''; ?><?php echo Config::get('title'); ?></title>
		<link rel="shortcut icon" href="<?php echo Uri::create('assets/img/favicon.ico'); ?>" type="image/x-icon">
		<?php if (!Auth::check()): ?>
			<meta name="description" content="An online hacking simulation Massive Multiplayer Online Role Playing Game based on your browser. We aim to provide something new, a fresh browser gameplay experience. The hacker game for you.">
			<meta name="revisit" content="After 3 days">
			<meta name="Expires" content="never">
			<meta name="robots" content="INDEX,FOLLOW">
			<meta name="language" content="en">
			<meta name="page-type" content="browser game, browsergame">
			<meta name="author" content="Secret Republic">
			<meta name="publisher" content="Secret Republic">
			<meta name="copyright" content="Secret Republic">
			<meta name="page-topic" content="free online hacking economical social and simulation browser based game"> <meta name="audience" content="all">
		<?php endif; ?>
	  <?php echo Asset::css('reset.css'); ?>
	  <?php echo Asset::css('bootstrap.min.css'); ?>
		<?php echo Asset::css('style.css'); ?>

		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,600&amp;subset=latin-ext" rel="stylesheet">
	</head>
	<body class="noselect">
		<?php if (Auth::check()):
			if (Session::get('last_active_update') + 10 <= time()) {
				DB::update('users')->set(array('last_active' => time()))->where('id', Auth::get('id'))->execute();
				Session::set('last_active_update', time());
			}

		 	// echo View::forge('tutorial/tutorial-handler');

			 $convs = DB::select(DB::expr('count(*) as count'))->where('parent_conversation_id', 'IS', NULL)->from('conversation')->where('unseen', 1)->where('last_replier_id', '!=', Auth::get('id'))->where(function($conv) {
			 			return $conv->where('user_1_id', Auth::get('id'))->or_where('user_2_id', Auth::get('id'));
				})->execute()->as_array()[0]['count'];

			 $rewards = DB::select(DB::expr('count(*) as count'))->from('reward')->where('user_id', Auth::get('id'))->where('claimed', 'IS', NULL)->execute()->as_array()[0]['count'];
		?>

		<h2 class="level">
			L<?php echo Auth::get('level'); ?>
		</h2>

	 <div class="toolbar-top-right">
			<i class="fa fa-cube"></i> <?php echo number_format(Auth::get('money')); ?>
		</div>
	<?php endif; ?>

			<?php if (!isset($hide_menu)): ?>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<nav class="navbar navbar-default navbar-fixed-bottom">
			  <div class="container">

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<div style="padding-top:5px;
						padding-bottom:5px;">
			      <ul class="nav navbar-nav text-center">

							<?php if (Auth::check()): ?>
			        <li><a href="<?php echo Uri::create('dashboard'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo Uri::create('quests'); ?>"><i class="fa fa-crosshairs" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('skills'); ?>"><i class="fa fa-diamond" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('knowledge'); ?>"><i class="fa fa-book" aria-hidden="true"></i></a></li>
			        <!--<li><a href="<?php echo Uri::create('train'); ?>"><i class="fa fa-calculator" aria-hidden="true"></i></a></li>-->
			        <!--<li><a href="<?php echo Uri::create('servers'); ?>"><i class="fa fa-server" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('shop'); ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('group'); ?>"><i class="fa fa-users" aria-hidden="true"></i></a></li>-->
						<?php else :?>
							<li><a href="<?php echo Uri::base(); ?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo Uri::create('create-account'); ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a></li>
						<?php endif; ?>

			      </ul>
			      <ul class="nav navbar-nav navbar-right text-center">
							<?php if (Auth::check()): ?>
								<li <?php echo $convs ? 'class="active"' : ''; ?>><a href="<?php echo Uri::create('conversations'); ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo $convs ? ' <small>('.$convs.')</small>' : ''; ?></a></li>
			        	<li <?php echo $rewards ? 'class="active"' : ''; ?>><a href="<?php echo Uri::create('rewards'); ?>"><i class="fa fa-gift" aria-hidden="true"></i><?php echo $rewards ? ' <small>('.$rewards.')</small>' : ''; ?></a></li>

			      		<li><a href="<?php echo Uri::create('rankings'); ?>"><i class="fa fa-trophy" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo Uri::create('dna'); ?>"><i class="fa fa-cog" aria-hidden="true"></i></a></li>


							<li>
								<a href="<?php echo Uri::create('authenticate/logout'); ?>" style=" opacity:.4;">
									<i class="fa fa-power-off" aria-hidden="true"></i>
								</a>
							</li>
						<?php endif; ?>
			      </ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>


		<?php endif; ?>
		<div class="container-fluid" style="min-height:400px; padding-top:0px;">
			<?php if (!isset($messages_handled)): ?>
				<div class="container">
					<?php echo View::forge('components/messages'); ?>
				</div>
			<?php endif; ?>
