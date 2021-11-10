<!DOCTYPE html>
<html lang="en" />
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Desarrollo Web Exámen Final | Segunda Serie</title>
    <link rel="stylesheet" href="static/css/css.css" />
</head>
<body>

<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();
include("views/header.php");

if (isset($_GET["register"])) {
    // <a href="register.php">Register new account</a>
    require_once("register.php");
}else{

    // ... ask if we are logged in here:
    if ($login->isUserLoggedIn() == true) {
        // the user is logged in. you can do whatever you want here.
        // for demonstration purposes, we simply show the "you are logged in" view.
        include("views/logged_in.php");
        // controller the cases
        if (isset($_GET['registerCase'])) {
            // <a href="register.php">Register new account</a>
            include("views/case/registerCase.php");
        }elseif(isset($_GET["update"])){
            $case_id = $_GET['id'];

            if(isset($_GET["updated"])) {
                //Ejecutar el codigo despues de que el usaurio envie el formulario
	            if(isset($_POST['submit'])){
                // load Case class
                require_once('classes/Case.php');
                $case = new Cases();

                $subject = $_POST['subject'];
                $description= $_POST['description'];
                $price = $_POST['price'];
                $status = $_POST['status'];
                $priority = $_POST['priority'];
                $case_id = $_POST['case_id'];
                $image= $_FILES['archivo']['name'];

		
	            if(strlen($image)<3){ $image= $_POST['old_image'];}

                $data = array(
	                "subject" => $subject,
	                "description" => $description,
	                "price" => $price,
	                "status" => $status,
	                "priority" => $priority,
	                "case_id" => $case_id,
	                "image" => $image
	            );

                $result = $case->updateCase($data);
                echo '<script type="text/javascript" src="./static/js/app.js>' , 'succesCase("'.$subject.'");' , '</script>';
	            }
                include("views/case/updateShow.php");
            }else{
                include("views/case/update.php");
            }
        }elseif(isset($_GET["delete"])){
            require_once('classes/Case.php');
            $case = new Cases();
            $case_id = $_GET['id'];
            $result = $case->deleteCase($case_id);
            include("views/case/show.php");
        }else{
            include("views/case/show.php");
        }
    
    } else {
        // the user is not logged in. you can do whatever you want here.
        // for demonstration purposes, we simply show the "you are not logged in" view.
        include("views/not_logged_in.php");
    }
}

include("views/footer.php");
?>

</body>

</html>