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
        <?php if ($text): ?>
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
        <?php if ($text): ?>
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
