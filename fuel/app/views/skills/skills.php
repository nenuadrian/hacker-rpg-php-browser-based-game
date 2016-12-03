<?php
use \Model\Skills;
use \Model\Missions;
use \Model\Servers;
echo View::forge('global/header');
?>

<div class="container">
	<div class="well text-center">
		Skills define and refine what it means to be you.

		Upgrade your abilities as fast as you can to gain more skill points. Your skills are separate from server skills, which are per machine.
	</div>
	<div class="alert alert-info text-center">
		<?php if (Auth::get('skill_points')): ?>
			<?php echo Auth::get('skill_points'); ?> assignable skill points available
		<?php else: ?>
			You do not have any available skill points, <?php echo Auth::get('username'); ?>.
		<?php endif; ?>
	</div>
	</div>
		<div class="row">
		<?php foreach(Skills::skills() as $skill_id => $s): ?>
			<div class="col-md-3 col-sm-6 text-center" style="margin-bottom:50px">
				<?php echo View::forge('components/modal', array('id' => 'skill-' . $skill_id, 'title' => $s['name'], 'content' => View::forge('skills/skill_modal', array('skill_id' => $skill_id, 's' => $s, 'user_skill' => $skills[$skill_id])))); ?>

			<a style="display: block;margin-left: 25px;" class="" data-toggle="modal" data-target="#skill-<?php echo $skill_id; ?>">
			<h3><?php echo $s['name']; ?></h3>

			<div style="margin-top:40px; margin-bottom:40px">
			<?php echo View::forge('components/progress-bar', array('type' => 'Circle', 'current' => $skills[$skill_id]['exp'] / ($skills[$skill_id]['exp_next'] / 100), 'max_width' => '100px', 'id' => $skill_id, 'text' => 'L'. $skills[$skill_id]['level'])); ?>

			</div>
			<?php echo $skills[$skill_id]['exp']; ?> / <?php echo $skills[$skill_id]['exp_next']; ?>
			</a>

			</div>
		<?php endforeach; ?>
		</div>
</div>
<?php echo View::forge('global/footer'); ?>
