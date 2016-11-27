<?php echo View::forge('global/header'); ?>


<?php //print_r($task);
?>
<h1 class="text-center">learning</h1><br/>
<?php echo View::forge('components/countdown', array('start_value' => $task['task_start'], 'remaining' => $task['remaining'], 'duration' => $task['task_duration'], 'max_width' => '400px')); ?>

<?php echo View::forge('global/footer'); ?>
