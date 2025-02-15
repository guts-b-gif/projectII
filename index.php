<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<link rel="stylesheet" type="text/css" href="libs/css/index.css">
<div class="login-page">
    <div class="text-center">
       <h2>Inventory Management System</h2>
       <h4>Sign in Here</h4>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="auth.php" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="name" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Password</label>
            <input type="password" name= "password" class="form-control" placeholder="password">
        </div>
        <div class="form-group">
        <button type="submit" style="background-color: #2ecc71; color: #ffffff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-align: center; margin: 0 auto; display: block;" class="btn btn-info">Login</button>
        </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
