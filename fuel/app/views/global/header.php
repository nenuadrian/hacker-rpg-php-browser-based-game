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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Josefin+Sans%3A300italic%2C300&amp;ver=4.6" type="text/css" media="all">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
		<?php echo Asset::css('style.css'); ?>
		<?php echo Asset::js('progressbar.min.js'); ?>

		<?php echo Asset::js('countdown.custom.js'); ?>
	</head>
	<body>
		<?php if (Auth::check()):
			if (Session::get('last_active_update') + 10 <= time()) {
				DB::update('users')->set(array('last_active' => time()))->where('id', Auth::get('id'))->execute();
				Session::set('last_active_update', time());
			}

		 	echo View::forge('tutorial/tutorial-handler');

			 $convs = DB::select(DB::expr('count(*) as count'))->where('parent_conversation_id', 'IS', NULL)->from('conversation')->where('unseen', 1)->where('last_replier_id', '!=', Auth::get('id'))->where(function($conv) {
			 			return $conv->where('user_1_id', Auth::get('id'))->or_where('user_2_id', Auth::get('id'));
				})->execute()->as_array()[0]['count'];

			 $rewards = DB::select(DB::expr('count(*) as count'))->from('reward')->where('user_id', Auth::get('id'))->where('claimed', 'IS', NULL)->execute()->as_array()[0]['count'];
		?>
			<br/>
			<nav class="navbar navbar-default">
			  <div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav text-center">
			        <li><a href="<?php echo Uri::create('dashboard'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i></a></li>
							<li><a href="<?php echo Uri::create('quests'); ?>"><i class="fa fa-crosshairs" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('skills'); ?>"><i class="fa fa-diamond" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('knowledge'); ?>"><i class="fa fa-book" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('train'); ?>"><i class="fa fa-calculator" aria-hidden="true"></i></a></li>
			        <!--<li><a href="<?php echo Uri::create('servers'); ?>"><i class="fa fa-server" aria-hidden="true"></i></a></li>
			        <li><a href="<?php echo Uri::create('shop'); ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>-->
			        <li><a href="<?php echo Uri::create('group'); ?>"><i class="fa fa-users" aria-hidden="true"></i></a></li>


			      </ul>
			      <ul class="nav navbar-nav navbar-right text-center">
			        <li <?php echo $rewards ? 'class="active"' : ''; ?>><a href="<?php echo Uri::create('rewards'); ?>"><i class="fa fa-gift" aria-hidden="true"></i><?php echo $rewards ? ' <small>('.$rewards.')</small>' : ''; ?></a></li>

			      <li><a href="<?php echo Uri::create('rankings'); ?>"><i class="fa fa-trophy" aria-hidden="true"></i> <small>(<?php echo number_format(Auth::get('ranking')); ?>)</small></a></li>
			        <li><a href="<?php echo Uri::create('dna'); ?>"><i class="fa fa-user-secret" aria-hidden="true"></i></a></li>

			        <?php if (Auth::get('group') == 2): ?>
				        	 <li><a href="<?php echo Uri::create('cardinal'); ?>"><i class="fa fa-bolt" aria-hidden="true"></i></a></li>
							<?php endif; ?>
			      </ul>
			    </div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>


			<h2 class="level">
			  L<?php echo Auth::get('level'); ?>
			</h2>
			<!--
			<div class="experience">
			  <div style="width:<?php echo Auth::get('experience') / (\Model\Hacker::experience(Auth::get('level') + 1) / 100); ?>%">
			  </div>
			</div>-->

			<div class="toolbar-bottom">
			  ID: <a href="<?php echo Uri::create('hacker/access/' . Auth::get('username')); ?>"><?php echo Auth::get('username'); ?></a>
			</div>
		 <div class="toolbar-bottom-right">
			  <i class="fa fa-cube"></i> <?php echo number_format(Auth::get('money')); ?>
			</div>

		<?php endif; ?>
		<div class="container-fluid" style="min-height:500px; padding-top:20px;">
