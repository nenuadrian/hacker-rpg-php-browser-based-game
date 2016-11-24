<?php echo View::forge('global/header'); ?>
<style>
  .mission {

    background-color: rgba(255, 255, 255, 0.05);
padding: 25px;
border-bottom: 5px solid rgb(17, 141, 236);
padding-left: 40px;
cursor:pointer;
  }
  .mission .name {
    font-size:30px;
  }

  .mission-content {
    background-color: rgb(17, 141, 236);

  }
  .mission-content div {
      padding:20px;
  }
  .mission p {margin:0; color: #8c8c8c;}

  form {margin:0;}

  .mission-content a {
    color:white;margin:0;
  }

  .mission-content a:hover,.mission-content a:active,.mission-content a:focus {
    color:black;
    border:none;
    background:none;
    box-shadow:none;
  }
</style>
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <a href="<?php echo Uri::base(); ?>" class="btn">back to dashboard</a><br/><br/>
    <div class="mission" onclick="$('#mission').collapse('toggle');$('#description').collapse('toggle')">
        <div class="name">Mission1</div>
        <p id="description" class="collapse in">description</p>
    </div>


<div class="collapse mission-content" id="mission">
  <div>
    ff
    <form method="post" class="text-center">
      <a href="<?php echo Uri::create('demo/play/9'); ?>" class="btn">accept mission</a>
    </form>
  </div>
</div>



  </div>
</div>
<?php echo View::forge('global/footer'); ?>
