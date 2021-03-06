<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }

        // echo '<pre>';
        // var_dump($_SESSION);
        // echo '</pre>';

    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "El username esta vacio!.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "La contraseña esta vacia!";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            // $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            try{
              $this->db_connection = new PDO ("mysql:host=".DB_HOST.";dbname=".DB_NAME.";",DB_USER,DB_PASS);

                // if no connection errors (= working database connection)
                // escape the POST stuff
                $user_name = $this->db_connection->quote(strip_tags($_POST['user_name'], ENT_QUOTES));
                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = 'SELECT user_name, user_email, user_password_hash FROM users WHERE user_name = '. $user_name ;
                $sql = $sql.' OR user_email ='.$user_name;
                $sql = $sql.';';

                $result_of_login_check = $this->db_connection->prepare($sql);
			    $result_of_login_check->execute();
              
                //$rows = $result_of_login_check->fetchAll();
                $rows = $result_of_login_check->rowCount();
                
                // echo "<hr>";
                // print_r ($rows);
                // echo "<hr>";
                // print_r ($result_of_login_check->fetchAll());
                // echo "<hr>";

                // // if this user exists
                if ($rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch(PDO::FETCH_ASSOC);

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row['user_password_hash'])) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['user_name'] = $result_row['user_name'];
                        $_SESSION['user_email'] = $result_row['user_email'];
                        $_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Contraseña incorrecta. Intentalo de nuevo.";
                    }
                } else {
                    $this->errors[] = "Este usuario no existe.";
                }
            } catch (PDOException $e) {
                $this->errors[] = "Database connection problem.";
                // print_r ($e);
            }
            
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        if ($this->isUserLoggedIn()){
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $message = '
        <div class="square">
        <h3>Has cerrado sesión exitósamente!</h3>
        <h3>VUELVE PRONTO :=)</h3>
        </div>
        ';
        $this->messages[] = "".$message;
    }

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
