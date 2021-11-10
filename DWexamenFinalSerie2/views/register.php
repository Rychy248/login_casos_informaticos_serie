<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

<!-- register form -->
<div class="contenedor">    
    <h2>Registrarse</h2>
    <form method="post" action="register.php" name="registerform">
    <div class="elemento">
        <!-- the user name input field uses a HTML5 pattern check -->
        <label for="login_input_username">Usuario (Solamente letras y numeros, de 2 a 64 carácteres)</label>
        <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
    </div>
    <div class="elemento">
    <!-- the email input field uses a HTML5 email type check -->
        <label for="login_input_email">Correo electrónico</label>
        <input id="login_input_email" class="login_input" type="email" name="user_email" required />
    </div>
    <div class="elemento">
        <label for="login_input_password_new">Contraseña(min. 6 carácteres)</label>
        <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
    </div>
    <div class="elemento">
        <label for="login_input_password_repeat">Confirmar Contraseña</label>
        <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
    </div>
    <div class="elemento">
        <input type="submit"  name="register" value="Register" />
    </div>
    
    </form>
    </div>
    </div>
    </div>
</div>
<!-- backlink -->

<!-- <a href="register.php">Register new account</a> -->
<div class="button-contenedor">   
    <h2>
          <a href="index.php">Regresar al Login</a>
    </h2>
</div>