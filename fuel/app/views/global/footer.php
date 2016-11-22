		</div>
		<footer>
		<?php if (Auth::check()): ?>
			<a href="<?php echo Uri::create('authenticate/logout'); ?>"><h1 class="text-center" style=" opacity:.4">
				<i class="fa fa-power-off" aria-hidden="true"></i>
			</h1></a>
		<?php endif; ?>
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
	</body>
</html>