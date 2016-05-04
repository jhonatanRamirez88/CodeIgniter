<head> <h1>Cita de pasciente</h1></head>
<section>
<? setlocale(LC_ALL,"es_ES@euro","es_ES","esp","es"); ?>
<? $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
$fecha = $dias[date('N', strtotime('2008-02-25'))]; ?> 

	<form method="POST" action="<?php echo base_url(); ?>index.php/Cita/RecibirVerNuevo">						
			<div class="4u 12u$(xsmall)">
			<?php foreach ($horas as $doc): ?>
				<input name="cvedoc" type="hidden" value="<?php echo $doc['cdoc']; ?>"/>
				<?php endforeach; ?>	
			</div>


			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Nombre del doctor:					
					<?php foreach ($horas as $doc): ?>
						<label name="nombre" value="<?php $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['appat']?></label>
						<?php echo $doc['cdoc'] ;?>
					<?php endforeach; ?>					
				</div>		
			</div>


			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Hora inicio de consultas:					
					<?php foreach ($horas as $doc): ?>
						<label name="hini" value="<?php echo $doc['hini']?>"> <?php $ini = $doc['hini'] ?>  <?php echo $doc['hini']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>

			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Hora fin de consultas:					
					<?php foreach ($horas as $doc): ?>
						<label name="hfin" value="<?php echo $doc['hfin']?>"> <?php $fin = $doc['hfin'] ?>   <?php echo $doc['hfin']?></label>
					<?php endforeach; ?>					
				</div>		
			</div>



			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona un paciente:
					<div class="select-wrapper">
						<select name="doctor" >
						<option value=""></option>
						<?php foreach ($pac as $doc):  ?>
							<option class="valor" value="<?php echo $doc['cve']?>"><?php echo $doc['nombre']?> <?php echo $doc['appat']?></option>
						<?php endforeach; ?>			
						</select>
					</div><!-- termina el div select wrapper-->
				</div>
			</div>
<?php
	/*Generamos las fechas que puede seeccionar el usuario siempre y cuando
	coincidan con el dia seleccionado por el usuario
	*/
	$val_dia = NULL;
	switch($numero_dia){
		case 1:
			$val_dia = "Monday";
			break;
		case 2:
			$val_dia = "Tuesday";
			break;
		case 3:
			$val_dia = "Wednesday";
			break;
		case 4:
			$val_dia = "Monday";
			break;
		case 5:
			$val_dia = "Thursday";
			break;
		case 6:
			$val_dia = "Saturday";
			break;									

	}
	$edo = date_default_timezone_set ( "America/Mexico_City" );
	$endDate = strtotime("+2 Month");
	$fechas_por_dia =array();
	for($i = strtotime($val_dia, strtotime("tomorrow")); $i <= $endDate; $i = strtotime('+1 week', $i)){
		$fechas_por_dia[] = date('d-m-Y', $i);
	}
?>

<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
					Seleccione fecha:
					<select name="dia_cita">
					<?php foreach ($fechas_por_dia as $fec): ?>
						<option value="<?php echo $fec ?>"><?php echo $fec ?></option>
					<?php endforeach; ?>					
					</select>
				</div>		
			</div>


				


	<!-- horas ocupadas con la consulta hacia las citas si tengo una hora que este ocupada en citas la omite para no dar opcion a que la escoja-->
<?php 
	$ini; 
	$fin; 
	$tamaño = $fin - $ini;
?>




<?php

$arreglo= array();
for ( $i = (int)$ini; $i < (int)$fin; $i+=1)
{
	$arreglo[$i]=$i;
}//fin del for

if($ocu == FALSE){
	$disponible = $arreglo;
}else{
	foreach ($ocu as $var => $value) {
		 $modificado[(int)$value['hora']] = (int)$value['hora'];//nos dice los dias ocupados
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

}

?>


			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Hora que desea la consulta:

					<div class="select-wrapper">
						<select name="hora_cita" >
						<?php foreach ($disponible as $doc => $value): ?>
							<option class="valor" value="<?php echo $value.':00:00' ?>"><?php echo $value.':00:00'?></option>
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