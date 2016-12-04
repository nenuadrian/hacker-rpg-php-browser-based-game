<?php

$id = isset($id) ? $id : rand(1, 9999999999);
$remaining = isset($remaining) ? intval($remaining) : 0;
$duration = isset($duration) ? intval($duration) : 0;

$countdown_id = 'countdown_' . $id;

$bar_type = 'Circle';
?>

<?php if (false && !isset($hide_bottom_count)): ?>
<div class="countdown-bottom" >
  <div style="width:0%" id="bar_<?php echo $countdown_id; ?>_bottom">
  </div>
</div>
<?php endif; ?>

<?php $bar = array('type' => 'Circle', 'current' => 0, 'id' => $countdown_id, 'text' => '');
if (isset($max_width)) $bar['max_width'] = $max_width;

echo View::forge('components/progress-bar', $bar); ?>
<?php
  $countdown_id = 'bar_' . $countdown_id;
  GlobalJs::add("var ${countdown_id} = new Countdown({
    remaining: ${remaining},
    duration: ${duration},
    progressBar: ${countdown_id},
    " . (!isset($hide_bottom_count) ? "bottomProgress: '${countdown_id}_bottom'," : '') . "
  });");
?>
