<div class="modal fade" role="dialog" id="<?php echo $id; ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo html_entity_decode($title); ?></h4>
      </div>
      <div class="modal-body">
      	<?php if (isset($eval)): ?>
      		<?php eval(html_entity_decode($content)); ?>
      	<?php else: ?>
	      	<?php echo html_entity_decode($content); ?>
	      <?php endif; ?>
      </div>
      
    </div>
  </div>
  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
</div>

<?php if (isset($auto_open)): ?>
<script>
$('#<?php echo $id; ?>').modal({});
</script>
<?php endif; ?>