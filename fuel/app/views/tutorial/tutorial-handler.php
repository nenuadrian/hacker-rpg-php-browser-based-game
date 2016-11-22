<?php use \Model\Hacker; 

if (Auth::get('tutorial_enabled') && Auth::get('tutorial_step') < 5): 
$step = \DB::select()->where('step_id', Auth::get('tutorial_step'))->from('tutorial_step')->execute()->as_array()[0];
eval("function check_tutorial_completion() { " . $step['completion_conditions'] . " }"); 
if(check_tutorial_completion()) {
	Hacker::save(array('tutorial_step' => Auth::get('tutorial_step') + 1));
	Messages::modal('tutorial');
	Response::redirect(Uri::current());
}
?>
<!-- TUTORIAL -->
<?php echo View::forge('components/modal', array('id' => 'modal-tutorial', 'title' => $step['title'], 'content' => $step['story'], 'eval' => true )); ?>


<a data-toggle="modal" data-target="#modal-tutorial" class="tutorial-notice"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a>
<?php endif; ?>