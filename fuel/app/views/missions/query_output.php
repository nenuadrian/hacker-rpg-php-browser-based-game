<?php if ($cql): ?>
      <div class="panel panel-default">
        <div class="panel-heading">CQL execution results</div>
        <div class="panel-body" style="max-height:400px">
          <?php if (is_array($cql['output'])): ?>
            <?php if (!count($cql['output'])): ?>
              your query did not match any results
            <?php else: ?>
              <div class="table-responsive">
                <table class="table table-condensed">
                <thead>
                  <?php foreach(array_keys($cql['output'][0]) as $col): ?>
                    <th><?php echo strtolower($col); ?></th>
                  <?php endforeach; ?>
                </thead>
                <tbody>
                  <?php foreach($cql['output'] as $row): ?>
                    <tr>
                    <?php foreach($row as $col => $v): ?>
                      <td><?php echo $v; ?></td>
                    <?php endforeach; ?>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                </table>
              </div>
            <?php endif ;?>
          <?php else: ?>
            <?php echo $cql['output']; ?>
          <?php endif; ?>
        </div>
        <div class="panel-footer"><?php echo $cql['query']; ?></div>
      </div>
<?php endif;?>
