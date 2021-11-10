<!--
	 ANTONIO JORGE RICARDO HERNÁNDEZ GONZALES 
					1090-18-4098
 -->

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




<div class="case-container">
    <h1 class="white delete-space case-title-h1">Registrar un caso de  Informática</h1>
    <form id="formulario" action="index.php?registerCase" method="post" enctype="multipart/form-data">
    <!-- <form  onsubmit="validar()" id="formulario" action="index.php" method="post" enctype="multipart/form-data"> -->
    <div class="square-register">
        <div class="elemento">
                <label class="case-title-label" for="subject">Título del caso</label>
             	<input class="case-title-input" name="subject" type="text" placeholder="En muy pocas palabras! :)" required>
            </div> <!-- form-row end.// -->
        <div class="elemento">
            <label class="case-label" for="price">¿Cuánto costaría reparar esto?</label>
            <input class="case-data-input" name="price" type="number" step="0.2" placeholder="100" required>
            <label class="case-label" for="status">Estado del caso</label>
            <select class="data-input" name="status">
                <option value="1" selected>Creado</option>
                <option value="2">En proceso</option>
                <option value="3">Terminado</option>
            </select>
        </div> <!-- form-row end.// -->
	    <div class="elemento">
            <label class="case-label" for="priority">Prioridad del caso</label>
            <select class="data-input" name="priority">
                <option value="1">Urgente</option>
                <option value="2">Importante</option>
                <option value="3" selected>Puede esperar</option>
            </select>
            <label  class="case-label" for="image">Adjunte Imagen</label>
	      	<input class=""  type="file" id="image" accept="image/jpeg , image/png" name="archivo">
        </div> <!-- form-row end.// -->
	    <div class="elemento">
                <label class="case-label resalt-light" for="description">Descripción del caso</label>
                <textarea id="#" name="description" rows="4" cols="50" placeholder="¿Que sucede?" required></textarea>
	    </div> <!-- form-row end.// -->
	    </div> 
        <!-- <input onclick="print_name()" type="submit" name="submit" class="" value="Insertar"> -->
        <input type="hidden" id="#" name="registerCase" value="True">
        <div class="elemento">
            <input class="input-submit" type="submit"  name="submit" value="Registrar" />
        </div>
    </form>
</div>
<div class="button-contenedor">
	<a class="font-25" href="index.php">Mostrar los casos existentes!</a>
</div>



<?php
    // include the configs / constants for the database connection
    try{
	    if(isset($_POST['submit'])){
        
            // load Case class
            require_once('classes/Case.php');
            $case = new Cases();

            $subject = $_POST['subject'];
		    $description= $_POST['description'];
		    $price = $_POST['price'];
		    $status = $_POST['status'];
		    $priority = $_POST['priority'];
	    	$image= $_FILES['archivo']['name'];
        
            $result = $case->registerCase();
        }else{
            echo  "no entro";
        }
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
?>
