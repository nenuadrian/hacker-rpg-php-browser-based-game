		</div>
		<footer>
			<?php if (Auth::get('group') == 2): ?>
					 <h1 class="text-center"><a href="<?php echo Uri::create('cardinal'); ?>"><i class="fa fa-bolt" aria-hidden="true"></i></a></h1>
			<?php endif; ?>

			<?php if (Input::headers('In-App', false)) \Model\Analytics::record('in-app', Input::headers()); ?>
		</footer>


		<?php echo Asset::js('jquery-3.1.0.min.js'); ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
		<!--	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>-->
			<?php echo Asset::js('bootstrap.min.js'); ?>

		<?php echo Asset::js('progressbar.min.js'); ?>
		<?php echo Asset::js('countdown.custom.js'); ?>
		<?php echo Asset::js('global.js'); ?>

		<?php $voice = Messages::get('voice'); if (count($voice)): $voice = $voice[count($voice) - 1];  ?>
			<?php if (Auth::check() && Auth::get('voice_enabled')): ?>
				<audio style="display:none;" id="voice">
					<source src="<?php echo Uri::create('voice/speak/' . $voice->message . '/ogg'); ?>" type="audio/ogg">
					<source src="<?php echo Uri::create('voice/speak/' . $voice->message . '/mp3'); ?>" type="audio/mpeg">
				</audio>
				<script type="text/javascript">
					aiSpeak("<?php echo $voice->message; ?>");
				</script>
			<?php endif; ?>
		<?php endif; ?>


		<?php $modal = Messages::get('modal', null, 1); if (count($modal)): $modal = $modal[0];  ?>
			<?php if ($modal->message == 'tutorial'): ?>
				<?php GlobalJs::add("	$('#modal-tutorial').modal({});"); ?>
			<?php else: ?>
				<?php echo View::forge('components/modal', array('id' => 'modal-footer', 'title' => $modal->title, 'content' => $modal->message, 'auto_open' => true)); ?>
			<?php endif;?>

		<?php endif; ?>
		<?php echo GlobalJs::render(); ?>
		<script>
			googleAnalytics('user_<?php echo Auth::get('id'); ?>')

		</script>
	</body>
</html>
