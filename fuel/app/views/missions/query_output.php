<?php if ($output): ?>
  <?php if (is_array($output)): ?>
    <?php if (!count($output)): ?>
      your query did not match any results
    <?php else: ?>
      <table class="table">
      <thead>
        <?php foreach(array_keys($output[0]) as $col): ?>
          <th><?php echo $col; ?></th>
        <?php endforeach; ?>
      </thead>
      <tbody>
        <?php foreach($output as $row): ?>
          <tr>
          <?php foreach($row as $col => $v): ?>
            <td><?php echo $v; ?></td>
          <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
    <?php endif ;?>
  <?php else: ?>
    <?php echo $output; ?>
  <?php endif; ?>
<?php endif;?>
