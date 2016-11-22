<?php 
use \Model\Skills;
use \Model\Missions;
use \Model\Servers;
echo View::forge('global/header'); 
?>

<div class="container">
<div class="well">
Skills define and refine what it means to be you.

Upgrade your abilities as fast as you can to gain more skill points. Your skills are separate from server skills, which are per machine.
</div>
<h3 class="text-center">
<?php echo Auth::get('skill_points'); ?> assignable skill points available
</h3>
</div>
<div style="padding:40px">
	<div class="row">
	<?php foreach(Skills::skills() as $skill_id => $s): ?>
		<div class="col-md-3 text-center" style="margin-bottom:50px">
		<?php echo View::forge('components/modal', array('id' => 'skill-' . $skill_id, 'title' => $s['name'], 'content' => View::forge('skills/skill_modal', array('s' => $s, 'user_skill' => $skills[$skill_id])))); ?>

		<a style="    display: block;
    margin-left: 25px;
    margin-right: 25px;
    background-color: rgba(66, 66, 66, 0.12);
    border: 2px solid rgba(43, 43, 43, 0.78);
    padding: 25px;
    border-top-left-radius: 25px;
    border-bottom-right-radius: 25px;" class="" data-toggle="modal" data-target="#skill-<?php echo $skill_id; ?>">
		<h3><?php echo $s['name']; ?></h3>

		<div style="margin-top:40px; margin-bottom:40px">
		<?php echo View::forge('components/progress-bar', array('type' => 'Circle', 'current' => $skills[$skill_id]['exp'] / ($skills[$skill_id]['exp_next'] / 100), 'max_width' => '100px', 'id' => $skill_id, 'text' => 'L'. $skills[$skill_id]['level'])); ?>

		</div>
		<?php echo $skills[$skill_id]['exp']; ?> / <?php echo $skills[$skill_id]['exp_next']; ?>
		</a>
		<?php if (Auth::get('skill_points')): ?>
		<form method="post">
		<button type="submit" name="add_point" value="<?php echo $skill_id; ?>" class="btn btn-default">add point</button>
		</form>

	<?php endif; ?>
		</div>
	<?php endforeach; ?>
	</div>
	</div>
<?php echo View::forge('global/footer'); ?>