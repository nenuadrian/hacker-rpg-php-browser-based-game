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
        <Br/>
        <div class="text-center">

        <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
      </div>
      </div>

    </div>
  </div>

</div>

<?php if (isset($auto_open) && $auto_open): ?>
  <?php GlobalJs::add("$('#${id}').modal({});"); ?>
<?php endif; ?>
