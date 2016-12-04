<?php echo View::forge('global/header'); ?>


<div class="container text-center">
  <div class="well">
    We are currently running an Alpha testing phase. Please let us know about any issues you've faced or suggestions you have!
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
  <form method="post">
    <textarea class="form-control" name="message" placeholder="Feedback"></textarea>
    <button class="btn btn-default btn-block" type="submit">send feedback</button>
  </form>
</div>
</div>
</div>

<?php echo View::forge('global/footer'); ?>
