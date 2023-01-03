<?php
include 'inc/header.php';
Session::CheckLogin();
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $userLog = $users->userLoginAuthotication($_POST);
}
if (isset($userLog)) {
  echo $userLog;
}

$logout = Session::get('logout');
if (isset($logout)) {
  echo $logout;
}



?>

<div class="card ">
  <div class="card-header">
    <center><img src="img/logo.png" alt="logo" style="width:400px;height:400px;"></center>
    <h3 class='text-center'>HOME ENERGY MANAGEMENT SYSTEM</h3>
    <h3 class='text-center'>ගෘහ බලශක්ති කළමනාකරණ පද්ධතිය</h3>
    <h3 class='text-center'>வீட்டு ஆற்றல் மேலாண்மை அமைப்பு</h3>
  </div>
  <div class="card-body">


    <div style="width:450px; margin:0px auto">

      <form class="" action="" method="post">
        <div class="form-group">
          <label for="email">Email විද්යුත් තැපෑල மின்னஞ்சல்</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Password රහස් පදය கடவுச்சொல்</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" name="login" class="btn btn-success">Login ඇතුල් වන්න உள்நுழைய</button>
        </div>


      </form>
    </div>


  </div>
</div>



<?php
include 'inc/footer.php';

?>