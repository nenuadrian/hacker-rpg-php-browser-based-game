		</div>
		<footer>
	
		</footer>

		<?php $voice = Messages::get('voice'); if (count($voice)): $voice = $voice[count($voice) - 1];  ?>
			<audio style="display:none;" autoplay>
			  <source src="<?php echo Uri::create('voice/speak/' . $voice->message . '/ogg'); ?>" type="audio/ogg">
			  <source src="<?php echo Uri::create('voice/speak/' . $voice->message . '/mp3'); ?>" type="audio/mpeg">
			Your browser does not support the audio element.
			</audio>
		<?php endif; ?>
		<?php $modal = Messages::get('modal', null, 1); if (count($modal)): $modal = $modal[0];  ?>
			<?php if ($modal->message == 'tutorial'): ?>
				<script>
				$('#modal-tutorial').modal({});
				</script>
			<?php else: ?>

			<?php echo View::forge('components/modal', array('id' => 'modal-footer', 'title' => $modal->title, 'content' => $modal->message, 'auto_open' => true)); ?>

			<?php endif;?>
		<?php endif; ?>
		<?php echo Asset::js('jquery-3.1.0.min.js'); ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
		<!--	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>-->
			<?php echo Asset::js('bootstrap.min.js'); ?>

		<?php echo Asset::js('progressbar.min.js'); ?>
		<?php echo Asset::js('countdown.custom.js'); ?>

		<script type="text/javascript">
			<?php echo GlobalJs::render(); ?>
		</script>
	</body>
</html>
