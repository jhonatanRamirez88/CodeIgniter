<head> <h1>Cita de pasciente</h1></head>
<section>

	<form method="POST" action="<?php echo base_url(); ?>index.php/Paciente/verNuevo">						
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Nombre del doctor:					
					<?php foreach ($horas as $doc): ?>
						<label name="nombre" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['appat']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>


			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Hora inicio de consultas:					
					<?php foreach ($horas as $doc): ?>
						<label name="hini" value=""> <?php $ini = $doc['hini'] ?>  <?php echo $doc['hini']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>

			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Hora fin de consultas:					
					<?php foreach ($horas as $doc): ?>
						<label name="hfin" value=""> <?php $fin = $doc['hfin'] ?>   <?php echo $doc['hfin']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>


			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona un paciente:
					<div class="select-wrapper">
						<select name="doctor" >
						<option value=""></option>
						<?php foreach ($pac as $doc): ?>
							<option class="valor" value="<?php echo $doc['cve']?>"><?php echo $doc['nombre']?> <?php echo $doc['appat']?></option>
						<?php endforeach; ?>			
						</select>
					</div><!-- termina el div select wrapper-->
				</div>
			</div>


				


	<!-- horas ocupadas con la consulta hacia las citas si tengo una hora que este ocupada en citas la omite para no dar opcion a que la escoja-->
<?php 
	$ini; 
	$fin; 
	$tamaño = $fin - $ini;
?>




<?php
$ocupa;
		/*foreach ($ocu as $doc): 
						$ocupa= (int)$doc['hora'];											
/*				for ( $i = (int)$ini; $i < (int)$fin; $i+=1)
					{
						if ($i == $ocupa) {
								echo "</br>quite ";								
							}else{
								
									echo "<br/> uno $i";																	
						}
					}//fin del for


					for ( $i = $tamaño; $i < (int)$fin; $i+=1)
					{
						if ($i == $ocupa) {
								echo "</br>quite ";								
							}else{
								
									echo "<br/> uno $i";																	
						}
					}//fin del for



		endforeach;

*/

$arreglo= array();
for ( $i = (int)$ini; $i < (int)$fin; $i+=1)
{
	$arreglo[$i]=$i;
}//fin del for




foreach ($ocu as $var => $value) {
	 $modificado[$var+11] = (int)$value['hora'];//nos dice los dias ocupados
}

foreach($arreglo as $key => $value){//arreglo tiene los dias completos 
  if(!isset($modificado[$key])){
       unset($modificado[$key]);
  }
}
 
// Si $aDatos es un array de estructura que deberia guardarse como referencia crea un nuevo array con la diferencia de valores
foreach($arreglo as $key => $value){
  if(!isset($modificado[$key])){
       $disponible[$key] = $value; //horas disponibles que mostrare en el combobox
  }
}

?>


			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Hora que desea la consulta:
					<div class="select-wrapper">
						<select name="hora_cita" >
						<option value=""></option>
						<?php foreach ($disponible as $doc): ?>
							<option class="valor" value=""><?php echo $doc?></option>
						<?php endforeach; ?>			
						</select>
					</div><!-- termina el div select wrapper-->
				</div>
			</div>




<div class="row uniform 50%">
			<div class="5u 12u$(xsmall)">
			<ul class="actions">
				<li><input type="submit" value="Dar de alta cita" class="special" /></li>		
			</ul>
			</div>
</div>


	</form>
</section>