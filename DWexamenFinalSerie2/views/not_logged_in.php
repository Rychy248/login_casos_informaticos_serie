<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

<!-- login form box -->
<div class="contenedor">    
    <h2>Login</h2>
    <form method="post" action="index.php" name="loginform">
        <div class="elemento">
            <label for="login_input_username">Username</label>
            <input id="login_input_username" class="login_input" type="text" name="user_name" required />
         </div>
         <div class="elemento">
           <label for="login_input_password">Password</label>
           <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
          </div>
         <div class="elemento">
              <input type="submit"  name="login" value="Login" />
         </div>
    </form>
</div>
<!-- <a href="register.php">Register new account</a> -->
<div class="button-contenedor">   
    <h2>
        <a href="index.php?register">Registrar una nueva cuenta</a>
    </h2>
</div>