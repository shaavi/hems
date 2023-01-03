<?php
include 'inc/header.php';
Session::CheckLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {

  $register = $users->userRegistration($_POST);
}

if (isset($register)) {
  echo $register;
}


?>


<div class="card ">
  <div class="card-header">
    <h3 class='text-center'>User Registration ලියාපදිංචි කිරීම பதிவு</h3>
  </div>
  <div class="cad-body">



    <div style="width:600px; margin:0px auto">

      <form class="" action="" method="post">
        <div class="form-group pt-3">
          <label for="name">Name නම பெயர்</label>
          <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="username">Username පරිශීලක නාමය பயனர் பெயர்</label>
          <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email විද්යුත් තැපෑල மின்னஞ்சல்</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="mobile">Mobile Number දුරකථන අංකය கைபேசி எண்</label>
          <input type="text" name="mobile" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password රහස් පදය கடவுச்சொல்</label>
          <input type="password" name="password" class="form-control">
          <input type="hidden" name="roleid" value="3" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" name="register" class="btn btn-success">Register ලියාපදිංචි කරන්න பதிவு</button>
        </div>


      </form>
    </div>


  </div>
</div>



<?php
include 'inc/footer.php';

?>