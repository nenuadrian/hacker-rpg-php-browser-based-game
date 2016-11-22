<?php echo View::forge('global/header'); ?>

<div class="container">
<table class="table">
<thead>
<tr><th>test</th><th>test2</th></tr>
</thead>
<tbody>
<tr><td>23423</td><td>34gre</td></tr>
<tr><td>23423</td><td>34gre</td></tr>
<tr><td>23423</td><td>34gre</td></tr>
</tbody>
</table>
<div class="well"> well
</div>

<div class="well well-blue">well-blue</div>
<div class="well well-dark">well-dark</div>

	<input type="text" class="form-control text-center" placeholder="user id" />
			<select class="form-control"><option>test</option></select>
			<textarea class="form-control"></textarea>
			<a class="btn btn-block btn-default" href="register.php">btn</a>
			<a class="btn btn-block btn-sm" href="register.php">btn-sm</a>
			<a class="btn btn-block btn-success" href="register.php">btn-success</a>
			<a class="btn btn-block btn-info" href="register.php">btn-info</a>
			<a class="btn btn-block btn-danger" href="register.php">btn-danger</a>
			<a class="btn btn-block btn-warning" href="register.php">btn-warning</a>
			<hr/>
			<div class="alert alert-danger">danger</div>
			<div class="alert alert-success">success</div>
			<div class="alert alert-info">info</div>
			<div class="alert alert-warning">warning</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<?php echo View::forge('components/modal', array('id' => 'myModal', 'title' => 'Modal title', 'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut dolor mi, feugiat vel finibus eget, egestas eget elit. Sed condimentum neque nec pretium convallis. Donec sit amet arcu vitae leo malesuada iaculis. Sed et neque nec enim sagittis efficitur. Proin pretium pretium finibus. Curabitur eleifend orci vel lacus dictum, non laoreet felis tincidunt. Sed commodo, augue ac aliquet aliquet, velit magna faucibus orci, sed rutrum mauris magna eget sem. Suspendisse potenti. Maecenas pharetra, lacus a mattis sagittis, diam ex volutpat odio, vel viverra lacus orci ac dui.

Proin iaculis vitae nibh at pulvinar. Proin ornare arcu nec est efficitur, id sodales ante tincidunt. Nulla pharetra finibus tincidunt. Nulla mattis, elit ac ornare vehicula, turpis dui tempor elit, vel pulvinar velit libero a nibh. Quisque ornare lorem dolor, nec venenatis sapien semper ac. Pellentesque enim lorem, sagittis non sagittis sed, hendrerit sed arcu. Fusce interdum mattis quam, luctus mollis urna lobortis nec. Maecenas ullamcorper est ut sem accumsan suscipit. Maecenas sed dictum arcu, id laoreet odio. Quisque ultricies risus eget nibh tristique, eu finibus risus aliquam. Suspendisse ut enim sit amet dolor mattis hendrerit. Nulla eget vehicula ipsum, non dictum ante.

Fusce pellentesque nunc quis tortor iaculis lobortis eget dapibus lectus. Aenean sit amet nunc a ligula viverra semper. Pellentesque accumsan, erat quis efficitur interdum, ipsum nibh euismod metus, vel posuere dolor velit at tortor. Ut ornare, nisl in fermentum facilisis, nulla ex efficitur tortor, sit amet semper est ante vel est. Nunc mollis lectus metus, sit amet auctor libero molestie a. Ut aliquam a lacus rhoncus gravida. Aliquam sed consequat eros, at interdum neque. Vestibulum eu mollis ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque tempor metus eros. Vestibulum lobortis, purus at vehicula faucibus, magna ligula efficitur justo, a suscipit ante quam lobortis eros. Nam fermentum quam a accumsan mollis. In feugiat feugiat nisi, sit amet rutrum libero condimentum interdum. Nam ullamcorper dapibus dui.

Phasellus in magna est. Nulla nec gravida ante. Proin molestie suscipit augue, et pellentesque lacus posuere at. Morbi sagittis et lorem ac fringilla. Maecenas accumsan convallis suscipit. Ut rhoncus, arcu at maximus malesuada, dolor tellus luctus nulla, sodales suscipit erat elit vel velit. Etiam ac libero id ex lobortis vestibulum. Integer sagittis lacus accumsan lacus feugiat, sed condimentum dui varius. In vehicula id est quis venenatis. Nulla vitae turpis lorem.

Aliquam pellentesque lectus at turpis rutrum, sed faucibus odio rutrum. Etiam et lorem ac risus condimentum fringilla. Vestibulum dapibus consectetur nisl, sit amet mollis urna. Nunc eleifend ac nisl vitae porta. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus feugiat felis non ligula ornare eleifend. Nullam arcu neque, commodo eget ligula nec, efficitur ultrices enim. Interdum et malesuada fames ac ante ipsum primis in faucibus.')); ?>



<div class="list-group">
  <a href="#" class="list-group-item ">
    Cras justo odio
  </a>
  <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
  <a href="#" class="list-group-item">Morbi leo risus</a>
  <a href="#" class="list-group-item">Porta ac consectetur ac</a>
  <a href="#" class="list-group-item">Vestibulum at eros</a>
<br/>
  <div class="panel panel-default">
  	<div class="panel-heading">heading</div>
  	<div class="panel-body">body</div>
  	<div class="panel-footer">footer</div>
  	</div>
</div>


</div>


<?php echo View::forge('global/footer'); ?>
