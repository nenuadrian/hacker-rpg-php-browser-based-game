<?php if (!isset($id)) { $id = rand(1, 99999);  } ?>
<?php if (!isset($type)) { $type = 'Line';  } ?>
<div class="text-center">
<?php if ($type == 'Square'): ?>

  <div id="container_<?php echo $id; ?>" style="<?php echo isset($max_width) ? 'max-width: '.$max_width.';' : ''; ?>position:relative; left:50%;transform: translate(-50%, 0%);">

  <svg viewBox="0 0 100 100"><path d="M 1.5,2 L 98,2 L 98,98 L 2,98 L 2,2" stroke="#eee" stroke-width="1" fill-opacity="0"></path>
        <path id="container_<?php echo $id; ?>_path" d="M 0,2 L 98,2 L 98,98 L 2,98 L 2,4" stroke="#ED6A5A" stroke-width="4" fill-opacity="0" ></path></svg>
        <div class="progressbar-text" style="font-size:20px; position: absolute; left: 50%; top: 50%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: rgb(222, 222, 222);">
        <p><?php echo $text; ?></p>
  </div>
</div>
<?php elseif ($type == 'Triangle'): ?>
  <div id="container_<?php echo $id; ?>" style="<?php echo isset($max_width) ? 'max-width: '.$max_width.';' : ''; ?>position:relative; left:50%;transform: translate(-50%, 0%);">

  <svg viewBox="0 0 100 100"><path d="M 50,2 L 98,98 L 2,98 L 50,2" stroke="#eee" stroke-width="1" fill-opacity="0"></path>
      <path id="container_<?php echo $id; ?>_path" d="M 50,2 L 98,98 L 2,98 L 50,2" stroke="#0FA0CE" stroke-width="4" fill-opacity="0" ></path></svg>
      <div class="progressbar-text" style="font-size:20px; position: absolute; left: 50%; top: 65%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: rgb(222, 222, 222);">

      <p><?php echo $text; ?></p>
</div>
</div>

  <?php else: ?>
    <div id="container_<?php echo $id;?>" style="position:relative;display:inline-block;<?php echo isset($max_width) ? 'max-width: '.$max_width.';' : ''; ?>"></div>
  <?php endif ;?>
</div>
<?php
  GlobalJs::add(View::forge('components/progress-bar-js', array('type' => $type, 'id' => $id, 'text' => isset($text) ? $text : false, 'current' => $current)));
?>
