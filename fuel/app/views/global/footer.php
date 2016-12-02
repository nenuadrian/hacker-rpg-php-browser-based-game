		</div>
		<footer>
			<?php if (Auth::get('group') == 2): ?>
					 <h1 class="text-center"><a href="<?php echo Uri::create('cardinal'); ?>"><i class="fa fa-bolt" aria-hidden="true"></i></a></h1>
			<?php endif; ?>

			<?php if (Input::headers('In-App', false)) \Model\Analytics::record('in-app', Input::headers('In-App')); ?>
		</footer>
			<?php $voice = Messages::get('voice'); if (count($voice)): $voice = $voice[count($voice) - 1];  ?>
				<?php if (Auth::check() && Auth::get('voice_enabled')): ?>
				<audio style="display:none;" id="voice">
				  <source src="<?php echo Uri::create('voice/speak/' . $voice->message . '/ogg'); ?>" type="audio/ogg">
				  <source src="<?php echo Uri::create('voice/speak/' . $voice->message . '/mp3'); ?>" type="audio/mpeg">
				</audio>
				<script type="text/javascript">
					if (window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.interOp) {
						window.webkit.messageHandlers.interOp.postMessage({ action: "speak", voice: "<?php echo $voice->message; ?>" })
					} else if (typeof Android !== 'undefined' && Android.playSound) {
						Android.playSound('<?php echo $voice->message; ?>')
					} else {
						var x = document.getElementById("voice")
						x.autoplay = true
						x.load()
					}
				</script>
			<?php endif; ?>
		<?php endif; ?>

		<?php echo Asset::js('jquery-3.1.0.min.js'); ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
		<!--	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>-->
			<?php echo Asset::js('bootstrap.min.js'); ?>

		<?php echo Asset::js('progressbar.min.js'); ?>
		<?php echo Asset::js('countdown.custom.js'); ?>
		<?php echo Asset::js('global.js'); ?>


		<?php $modal = Messages::get('modal', null, 1); if (count($modal)): $modal = $modal[0];  ?>
			<?php if ($modal->message == 'tutorial'): ?>
				<?php GlobalJs::add("	$('#modal-tutorial').modal({});"); ?>
			<?php else: ?>
				<?php echo View::forge('components/modal', array('id' => 'modal-footer', 'title' => $modal->title, 'content' => $modal->message, 'auto_open' => true)); ?>
			<?php endif;?>

		<?php endif; ?>
<?php echo GlobalJs::render(); ?>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			<?php if (Auth::check()): ?>
				ga('create', 'UA-88039088-1', 'auto', {
				  userId: 'user_<?php echo Auth::get('id'); ?>'
				});
			<?php else: ?>
		  	ga('create', 'UA-88039088-1', 'auto');
			<?php endif; ?>
		  ga('send', 'pageview');

		</script>
	</body>
</html>
