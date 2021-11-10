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

	<h1 class="quit-space-text title">Casos de Informática</h1>
   
    <?php 
        require_once('classes/Case.php');
        $case = new Cases();
	    $result = $case->readCase();
		$rows_num = $result->rowCount();
        if ($rows_num > 0){
            $index = 1;
	        while($row = $result->fetch(PDO::FETCH_ASSOC)){
	        ?>
		<div class="case-container">
    		<h1 class="white delete-space case-title-h1">Caso No. <?php echo $index;?> : "<span class="resalt-light"><?php echo $row["subject"];?></span>"</h1>	
			<div class="square-register">
				<div class="elmento">
                	<label class="case-label">Precio: <span class="resalt"><?php echo $row["price"];?></span></label>
                	<label class="case-label">| Estado del caso: <span class="resalt"><?php echo $row["status"];?></span></label>
					<label class="case-label">| Prioridad del caso: <span class="resalt"><?php echo $row["priority"];?></span></label>
				</div> <!-- form-row end.// -->
				<div class="elemento">
					<label class="case-label resalt-light">Descripción del caso:</label>
					<div class="square">
						<label class="case-label update-descript" style="color:black;" ><?php echo $row["description"];?></label>
					</div>
					<br>
				</div> <!-- form-row end.// -->
				<center>
					<img class="img-case" src="static/images/<?php echo $row["image"];  ?>" alt="Imagen">
				</center>
			</div>
			<div class="button-contenedor-case">
				<h2 class="delete-space"><a class="" href="index.php?update&id=<?php echo $row["case_id"]; ?>">Editar <br>  <i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a><br></h2>
				<h2 class="delete-space"><a class="" href="index.php?delete&id=<?php echo $row["case_id"];?>">Eliminar<i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a><br></h2>
			</div>
		</div>
                <?php $index = $index + 1;?>    
	        <?php }
        }else{?>
        <div class="case-container">
			<div class="square-register">
				<h1 class="white delete-space case-title-h1">No hay casos registrados!</h1>	
			</div>
		</div>
			<?php
		} ?>

