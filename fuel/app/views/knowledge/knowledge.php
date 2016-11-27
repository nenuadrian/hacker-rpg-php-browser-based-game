<?php
use \Model\Knowledge;
use \Model\Skills;
 echo View::forge('global/header'); ?>

 <?php echo Asset::css('diamond-show/style.css'); ?>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
  <div class="cd-svg-clipped-slider" data-selected="M780,0H20C8.954,0,0,8.954,0,20v760c0,11.046,8.954,20,20,20h760c11.046,0,20-8.954,20-20V20
	C800,8.954,791.046,0,780,0z" data-lateral="M795.796,389.851L410.149,4.204c-5.605-5.605-14.692-5.605-20.297,0L4.204,389.851
	c-5.605,5.605-5.605,14.692,0,20.297l385.648,385.648c5.605,5.605,14.692,5.605,20.297,0l385.648-385.648
	C801.401,404.544,801.401,395.456,795.796,389.851z">
<?php $positions = array(1 => 'left', 2 => 'selected', 3 => 'right'); ?>
		<div class="gallery-wrapper">
			<ul class="gallery">
        <?php foreach($knowledge as $k_id => $k): ?>
				<li <?php echo in_array($k_id, array_keys($positions)) ? 'class="' . $positions[$k_id] . '"' : ''; ?>>
					<div class="svg-wrapper">
						<svg viewBox="0 0 800 800">
							<title><?php echo $k['name']; ?> </title>
							<defs>
								<clipPath id="cd-image-<?php echo $k_id; ?>">
									<path id="cd-morphing-path-<?php echo $k_id; ?>" d="<?php echo $k_id == 2 ? 'M780,0H20C8.954,0,0,8.954,0,20v760c0,11.046,8.954,20,20,20h760c11.046,0,20-8.954,20-20V20 C800,8.954,791.046,0,780,0z' : 'M795.796,389.851L410.149,4.204c-5.605-5.605-14.692-5.605-20.297,0L4.204,389.851 c-5.605,5.605-5.605,14.692,0,20.297l385.648,385.648c5.605,5.605,14.692,5.605,20.297,0l385.648-385.648 C801.401,404.544,801.401,395.456,795.796,389.851z'; ?>"/>
								</clipPath>
							</defs>

							<image height='800px' width="800px" clip-path="url(#cd-image-<?php echo $k_id; ?>)" xlink:href="<?php echo Uri::create('assets/img/knowledge/knowledge_' . $k_id .'.jpg'); ?>"></image>
							<use xlink:href="#cd-morphing-path-<?php echo $k_id; ?>" class="cover-layer" />
						</svg>
					</div> <!-- .svg-wrapper -->
				</li>
      <?php endforeach; ?>

			</ul>

			<nav>
				<ul class="navigation">
					<li><a href="#0" class="prev">Prev</a></li>
					<li><a href="#0" class="next">Next</a></li>
				</ul>
			</nav>
		</div> <!-- .gallery-wrapper -->

		<ul class="caption">

      <?php foreach($knowledge as $k_id => $k): ?>
        <li <?php echo $k_id == 2 ? 'class="selected"' : ''; ?>>
          <h2><?php echo $k['name']; ?></h2>
          <p>Level <?php echo $level = $user_knowledge[$k_id]['level']; ?></p>
          <p> <strong>skill points obtainable with the next level</strong></p>
          <?php foreach ($user_knowledge[$k_id]['skills'] as $skill_id => $p): ?>
            <p><?php echo $p; ?> <em><?php echo Skills::skills()[$skill_id]['name']; ?></em> points</p>
          <?php endforeach; ?>
          <p><strong>requirements for next level</strong></p>
          <?php if (isset($user_knowledge[$k_id]['requires']['level'])): ?>
            <p>Level <?php echo $user_knowledge[$k_id]['requires']['level']; ?></p>
          <?php endif; ?>
          <?php if (isset($user_knowledge[$k_id]['requires']['money'])): ?>
            <p><i class="fa fa-cube"></i> <?php echo $user_knowledge[$k_id]['requires']['money']; ?></p>
          <?php endif; ?>
          <?php foreach($user_knowledge[$k_id]['requires']['knows'] as $r_k_id => $r): ?>
            <p><?php echo $knowledge[$r_k_id]['name']; ?> at level <?php echo $r['level']; ?> [<?php echo $r['fulfilled'] ? 'yes' : 'no'; ?>]</p>
          <?php endforeach; ?>
          <?php if ($user_knowledge[$k_id]['requires']['fulfilled']): ?>
            <a href="<?php echo Uri::create('knowledge/learn/' . $k_id); ?>">learn</a>
          <?php else: ?>
            <div class="alert alert-danger">
              Requirements have not been fulfilled
            </div>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>

		</ul>
	</div> <!-- .cd-svg-clipped-slider -->
</div></div>




<?php echo GlobalJs::include_js('diamond-show/modernizr-custom.js'); ?>
<?php echo GlobalJs::include_js('diamond-show/snap.svg-min.js'); ?>
<?php echo GlobalJs::include_js('diamond-show/main.js'); ?>


<?php echo View::forge('global/footer'); ?>
