<section>
	<h1><?php echo $title; 
		?></h1>		

	<form method="POST" action="<?php echo base_url(); ?>index.php/cita/executeUpdate">
		<div class="row uniform 50%">

			<div class="4u 12u$(xsmall)">
				Doctor:
				<div class="select-wrapper">
					<select name="doctor" id="doctor" > 
						<?php foreach ($docs as $doc ): ?>
							 <option <?php if(strcmp ( $doc['cdoc'] , $cita['cve_doc'] ) == 0){echo("selected");}?> <?php echo"value='".$doc['cdoc']."'>".$doc['nom']." ".$doc['ape']; ?> </option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>		


			<div class="4u 12u$(xsmall)">
				Fecha:	
				<input type="date" step="1" min="<?php  date_default_timezone_set ( "America/Mexico_City" ); echo date('Y-m-d'); ?>" id="fecha" value="<?php echo $cita['fecha'] ?>" readonly></input>
			</div>
			
			<div class="4u 12u$(xsmall)">
				Hora:
				<div class="select-wrapper">
					<select name="hora" id="hora" readonly> 
						<option <?php echo"value='".$cita['hora']."'>".$cita['hora']; ?> </option>
					</select>
				</div>
			</div>			
			
			<div class="12u 12u$(xsmall)">
				<ul class="actions">
					<li><input type="submit" value="Guardar" class="special" /></li>
					<li><input type="reset" value="Limpiar" /></li>
				</ul>		
			</div>
		</div>
	</form>
</section>

<script type="text/javascript">
	//Desabilitar 
	$('#doctor').change(function (){
  		$("#fecha").attr("readonly", false);
	});

	$('#fecha').change(function (){
		$.ajax({
		  method: "GET",
		  url: "<?php echo base_url();?>index.php/Cita/get_horarios_doc_fecha",
		  data: { cvedoc: $('#doctor').val(), fecha: $('#fecha').val()}
		}).done(function( data ) {
			console.log(data);
			data = JSON.parse(data);
		    alert( "Data Saved: " + data.dia);
		});  		
	});	

</script>