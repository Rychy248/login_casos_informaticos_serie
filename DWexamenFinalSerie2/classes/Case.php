<?php

/**
 * Class Case
 * handles the case creat, read, update and deleted process
 */
class Cases
{
    /* @var object The database connection */
    private $db_connection = null;
    /* @var array Collection of error messages */
    public $errors = array();
    /* @var array Collection of success / neutral messages */
    public $messages = array();

    public function readCase($case_id=null)
    {
        
        try{
            $this->db_connection = new PDO ("pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";",DB_USER,DB_PASS);
            // SELECT c.case_id, c.subject, c.description, c.price,
            // (SELECT s.status 
            //  FROM case_status AS s
            //  WHERE s.status_id = c.case_status
            // ) AS status,
            // (SELECT p.priority
            //  FROM case_priority AS p
            //  WHERE p.priority_id = c.case_priority
            // ) AS priority,
            // c.image
            // FROM "case" AS c;
            // echo "<hr> <h1>Llegamos aqui</h1>";
            $sql = "SELECT c.case_id, c.subject, c.description, c.price,";
            $sql = $sql."(SELECT s.status FROM case_status AS s WHERE s.status_id = c.case_status ) AS status,";
            $sql = $sql."(SELECT p.priority FROM case_priority AS p WHERE p.priority_id = c.case_priority) AS priority,";
            $sql = $sql.'c.image FROM "case" AS c';
            if (is_null($case_id)){
                $sql = $sql.';';
            }else{
                $sql = $sql.' WHERE case_id ='.$case_id;
                $sql = $sql.';';
            }
            // echo "<hr> <h1>Llegamos aqui".$sql."</h1>";
            $cases = $this->db_connection->prepare($sql);
			$cases->execute();
              
            // $rows = $cases->fetchAll();
            //     
            // echo "<hr> <h1>Llegamos aqui</h1>";
            // print_r ($rows);
            // echo "<hr>";
                
            // get result row (as an object)
            // $result_rows = $cases->fetchAll(PDO::FETCH_ASSOC);
            // return $result_rows;
            return $cases;

        } catch (PDOException $e) {
            $this->errors[] = "Database connection problem.";
            // print_r ($e);
        } catch (Exception $e) {
            $this->errors[] = "Algo desconocido salio mal.";
            echo "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
        }
    }

    public function deleteCase($case_id=null)
    {
        
        try{
            $this->db_connection = new PDO ("pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";",DB_USER,DB_PASS);
            
            // DELETE FROM "case" WHERE case_id = cas_id_var;
            $sql = 'DELETE FROM "case" WHERE case_id='.$case_id;
            $sql = $sql.';';

            $cases = $this->db_connection->prepare($sql);
			$cases->execute();
              
            // $rows = $cases->fetchAll();
            //     
            // echo "<hr>";
            // print_r ($rows);
            // echo "<hr>";
                
            // get result row (as an object)
            // $result_rows = $cases->fetchAll(PDO::FETCH_ASSOC);
            // return $result_rows;
            return $cases;

        } catch (PDOException $e) {
            $this->errors[] = "Database connection problem.";
            // print_r ($e);
        } catch (Exception $e) {
            $this->errors[] = "Algo desconocido salio mal.";
            echo "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
        }
    }
    public function updateCase($data=null)
    {
        
        try{
            $this->db_connection = new PDO ("pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";",DB_USER,DB_PASS);
        
            $carpetaImagenes = 'static/images/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            
            //subir la imagen 250x250
            move_uploaded_file($_FILES['archivo'] ['tmp_name'],$carpetaImagenes . $_FILES['archivo'] ['name']);

            $subject = $data['subject'];
            $description= $data['description'];
            $price = $data['price'];
            $status = $data['status'];
            $priority = $data['priority'];
            $image= $data['image'];
            $case_id= $data['case_id'];
            if (strlen($image)<3){
                $image = "default_case_picture.png";
            }
            // UPDATE "case" 
            // SET case_status=2, subject='Actualizado'
            // WHERE case_id = 1;

            $sql = 'UPDATE  "case" SET ';
            $sql = $sql."subject='".$subject."',";
            $sql = $sql."description='".$description."',";
            $sql = $sql."price='".$price."',";
            $sql = $sql."case_status=".$status.",";
            $sql = $sql."case_priority=".$priority.",";
            $sql = $sql."image='".$image."'";
            $sql = $sql." WHERE case_id=".$case_id;
            $sql = $sql.';';
            // echo $sql;
            $query_case_updated = $this->db_connection->prepare($sql);
            $query_case_updated->execute();

            // echo $sql;
            $cases = $this->db_connection->prepare($sql);
			$cases->execute();
              
            // $rows = $cases->fetchAll();
            //     
            // echo "<hr>";
            // print_r ($rows);
            // echo "<hr>";
                
            // get result row (as an object)
            // $result_rows = $cases->fetchAll(PDO::FETCH_ASSOC);
            // return $result_rows;
            return $cases;

        } catch (PDOException $e) {
            $this->errors[] = "Database connection problem.";
            // print_r ($e);
        } catch (Exception $e) {
            $this->errors[] = "Algo desconocido salio mal.";
            echo "Caught Exception ('{$e->getMessage()}')\n{$e}\n";
        }
    }

    public function registerCase()
    {

            // create a database connection

            try{
                
                $this->db_connection = new PDO ("pgsql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME.";",DB_USER,DB_PASS);
                // if no connection errors (= working database connection)

                // escaping, additionally removing everything that could be (html/javascript-) code
                // $user_name = $this->db_connection->quote(strip_tags($_POST['user_name'], ENT_QUOTES));
                // $user_email = $this->db_connection->quote(strip_tags($_POST['user_email'], ENT_QUOTES));
                // $user_password = $_POST['user_password_new'];
                $carpetaImagenes = 'static/images/';

                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes);
                }
                
                //subir la imagen 250x250
                move_uploaded_file($_FILES['archivo'] ['tmp_name'],$carpetaImagenes . $_FILES['archivo'] ['name']);
                // echo "<hr> <h1>Llegamos aqui</h1>";
                $subject = $_POST['subject'];
                $description= $_POST['description'];
                $price = $_POST['price'];
                $status = $_POST['status'];
                $priority = $_POST['priority'];
                $image= $_FILES['archivo']['name'];
                if (strlen($image)<3){
                    $image = "default_case_picture.png";
                }
                // echo "<hr> <h1>Llegamos aqui</h1>";
                $sql = 'INSERT INTO "case" (subject, description, price, case_status, case_priority, image) VALUES(';
                $sql = $sql."'".$subject."',";
                $sql = $sql."'".$description."',";
                $sql = $sql."'".$price."',";
                $sql = $sql."".$status.",";
                $sql = $sql."".$priority.",";
                $sql = $sql."'".$image."'";
                $sql = $sql.');';
                // echo "<hr> <h1>Llegamos aqui ".$sql."</h1>";
                $query_new_case_insert = $this->db_connection->prepare($sql);
                $query_new_case_insert->execute();
                // echo "<hr> <h1>Llegamos aquim ejecutado</h1>";
                // if user has been added successfully
                if ($query_new_case_insert) {
                    $this->messages[] = "Caso de informática creado";
                } else {
                    $this->errors[] = "Algo sucedio mal";
                }
            } catch (PDOException $e) {
                $this->errors[] = "Sorry, no database connection.";
                // print_r ($e);
            }
        
    }

    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}

?>