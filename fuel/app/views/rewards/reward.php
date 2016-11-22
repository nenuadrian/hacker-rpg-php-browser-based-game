<?php echo View::forge('global/header'); ?>


<?php print_r($reward); ?>

<?php if (!$reward['claimed']): ?>
<form method="post" class="text-center">
    	<button type="submit" class="btn btn-default" name="claim" value="true">claim reward</button>
</form>
<?php endif; ?>
<?php echo View::forge('global/footer'); ?>