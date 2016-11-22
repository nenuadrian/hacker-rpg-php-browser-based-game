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
<script>
<?php if ($type == 'Line'): ?>
	var bar_<?php echo $id; ?> = new ProgressBar.Line('#container_<?php echo $id;?>', {
  strokeWidth: 4,
  easing: 'easeInOut',
  duration: 1400,
  color: '#209eff',
  trailColor: '#209eff',
  trailWidth: 0.1,
  svgStyle: {width: '100%', height: '100%'},
  text: {
    style: {
      // Text color.
      // Default: same as stroke color (options.color)
      color: '#999',
      position: 'absolute',
      right: '0',
      top: '30px',
      padding: 0,
      margin: 0,
      transform: null
    },
   
    autoStyleContainer: false
  },
  from: {color: '#209eff'},
  to: {color: '#209eff'},
  step: (state, bar) => {
    bar.setText(Math.round(bar.value() * 100) + ' %');
  }
});
<?php elseif ($type == 'Circle'): ?>

  var bar_<?php echo $id; ?> = new ProgressBar.Circle('#container_<?php echo $id;?>', {

        color: '#dedede',
        trailColor: '#eee',
        trailWidth: 1,
        duration: 1400,
        easing: 'bounce',
        strokeWidth: 6,
        from: {color: '#dedede', a:0},
        to: {color: '#dedede', a:1},
        <?php if (isset($text)): ?>
        text: { value: '<?php echo $text; ?>' },
        <?php endif; ?>
      });
<?php elseif ($type == 'SemiCircle'): ?>
var bar_<?php echo $id; ?> = new ProgressBar.SemiCircle('#container_<?php echo $id;?>', {

        color: '#dedede',
        trailColor: '#eee',
        trailWidth: 1,
        duration: 1400,
        easing: 'bounce',
        strokeWidth: 6,
        from: {color: '#dedede', a:0},
        to: {color: '#dedede', a:1},
        <?php if (isset($text)): ?>
        text: { value: '<?php echo $text; ?>' },
        <?php endif; ?>
      });
bar_<?php echo $id; ?>.text.style.fontSize = '2.5rem';
<?php elseif ($type == 'Square' || $type == 'Triangle'): ?>

var bar_<?php echo $id;?> = new ProgressBar.Path('#container_<?php echo $id; ?>_path', {
  easing: 'easeInOut',
  duration: 1400,
});
<?php endif;?> 


bar_<?php echo $id; ?>.animate(<?php echo $current / 100; ?>);  // Number from 0.0 to 1.0
</script>