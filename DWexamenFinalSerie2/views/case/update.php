<!--
	 ANTONIO JORGE RICARDO HERNÁNDEZ GONZALES 
					1090-18-4098
 -->

<script src="./static/js/app.js"></script>
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

    <?php 
        require_once('classes/Case.php');
        $case = new Cases();
	    $result = $case->readCase($case_id);
        if ($result != NULL){
	        $row = $result->fetch(PDO::FETCH_ASSOC);
	        $subject = $row["subject"];
	        $description = $row["description"];
	        $price = $row["price"];
	        $status = $row["status"];
	        $priority = $row["priority"];
	        $image = $row["image"];
			$case_id = $row["case_id"];

        } else{
            echo "No se hallaron datos";
        }
	?>
<div class="case-container">
    <h1 class="white delete-space case-title-h1">Actualizar caso de Informática "<span class="resalt-light"><?php echo $subject;?></span>"</h1>	
	<form id="formulario" action="index.php?update=True&updated=True&id=<?php echo $case_id; ?>" method="post" enctype="multipart/form-data">
	<!-- <form  onsubmit="validar()" id="formulario" action="index.php" method="post" enctype="multipart/form-data"> -->
		<div class="square-update">
        	<div class="elemento">
                	<label class="case-title-label" for="subject">Título del caso</label>
        			<input class="case-title-input" name="subject" type="text" value="<?php echo $subject;?>" required>
			</div> <!-- form-row end.// -->
			<div class="elmento">
                	<label class="case-label"  for="price">¿Cuánto costaría reparar esto?</label>
        			<input class="case-data-input" name="price" type="number" step="0.2" value="<?php echo $price;?>" required>

                	<label class="case-label" for="status">Estado del caso</label>
                	<select class="data-input" name="status">
						<?php
						if ($status==3) {
						?>
							<option value="1">Creado</option>
                  			<option value="2">En proceso</option>
                  			<option value="3" selected>Terminado</option>
						<?php
						}elseif($staus==2){
						?>
							<option value="1">Creado</option>
                  			<option value="2" selected>En proceso</option>
                  			<option value="3">Terminado</option>
						<?php
						}else{
						?>
							<option value="1"  selected>Creado</option>
                  			<option value="2">En proceso</option>
                  			<option value="3">Terminado</option>
						<?php
						}
						?>
                	</select>
			</div> <!-- form-row end.// -->
			<div class="elemento">
			<label class="case-label" for="priority">Prioridad del caso</label>
                	<select class="data-input" name="priority">
					<?php
						if ($priority==3) {
						?>
                  			<option value="1">Urgente</option>
                  			<option value="2">Importante</option>
                  			<option value="3" selected>Puede esperar</option>
						<?php
						}elseif($priority==2){
						?>
                  			<option value="1">Urgente</option>
                  			<option value="2" selected>Importante</option>
                  			<option value="3">Puede esperar</option>
						<?php
						}else{
						?>
                  			<option value="1" selected>Urgente</option>
                  			<option value="2">Importante</option>
                  			<option value="3">Puede esperar</option>
						<?php
						}
						?>
                	</select>
            	<label  class="case-label" for="image">Adjunte Imagen</label>
				<input class=""  type="file" id="image" accept="image/jpeg , image/png" name="archivo">
        	</div> <!-- form-row end.// -->
	    	<div class="">
				<label class="case-label resalt-light" for="description">Descripción del caso</label>
				<br>
				<textarea class="update-descript" name="description" rows="10" cols="50"required><?php echo $description;?></textarea>
				<img class="img" src="static/images/<?php echo $image;  ?>" alt="Imagen">	    
	    	</div> <!-- form-row end.// -->
			<input type="hidden" id="#" name="case_id" value="<?php echo $case_id;  ?>">
			<input type="hidden" id="#" name="old_image" value="<?php echo $image;  ?>">

        <!-- <input onclick="print_name()" type="submit" name="submit" class="" value="Insertar"> -->
		</div>
		<div class="elemento">
       		<input type="submit" name="submit" class="input-submit" value="Actualizar">
		</div>
	</form>
</div>
<div class="button-contenedor">
	<a class="font-25" href="index.php">Regresar!</a>
</div>

