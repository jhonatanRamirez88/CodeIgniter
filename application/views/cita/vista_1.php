<section>
	<form action="<?php echo base_url(); ?>index.php/Paciente/verNuevo">
		<div class="row uniform 50%">
						<div class="5u 12u$(xsmall)">
						<ul class="actions">
							<li><input type="submit" value="Dar de alta paciente" class="special" /></li>		
						</ul>
						</div>
			</div>
	</form>
	<form method="POST" action="<?php echo base_url(); ?>index.php/Cita/buscar">
			<div class="row uniform 50%">

				<div class="4u 12u$(xsmall)">
				Selecciona un doctor
					<div class="select-wrapper">
						<select name="doctor" id="doctor">
						<option value=""></option>
						<?php foreach ($pollo as $doc): ?>
							<option class="valor" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['ape']?></option>
						<?php endforeach; ?>			
						</select>
					</div><!-- termina el div select wrapper-->
				</div>
			</div>
			
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona el día
					<?php 		$edo = date_default_timezone_set ( "America/Mexico_City" ); ?>
					<input type="date" id ="fecha" name="dia" step="1" onclick="<?php $i = date("Y-m-d"); ?>;" min="<?php echo date("Y-m-d");?>" max="2018-12-31" value="<?php echo date("Y-m-d");?>">
				</div>
			</div>
			
			<input type="hidden"  name="cve_dia" id="cve_dia" value="" readonly></input>

			<div class="row uniform 50%">
						<div class="5u 12u$(xsmall)">
						<ul class="actions">
							<li><input type="submit" value="Buscar" class="special" id="btn1" disabled/></li>
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
	var coso;
	$('#fecha').change(function (){
		$.ajax({
		  method: "post",
		  url: "<?php echo base_url();?>index.php/Cita/get_horarios_doc_fecha",
		  data: { cvedoc: $('#doctor').val(), fecha: $('#fecha').val()}
		}).done(function( data ) {
			data = JSON.parse(data);
			coso = data;
			var str = data['dia'];
			console.log(str);
			if(data[0] == false){
				alert('No hay horarios disponibles del doctor en ese dia intente con otro dia');
				$('#btn1').attr('disabled', true);
			}else{
				if (data[0].lenght==0) {//si el data[0] contiene horario disponible le activo el boton
					alert('Horario lleno para ese dia del doctor intente con otro dia');
					$('#btn1').attr('disabled', true);	
				}else{//otro caso el data ==0 significa que no tiene horarios disponibles
					$('#btn1').attr('disabled', false);	
				}
				
			}
			$('#cve_dia').html(str);	
			document.getElementById("cve_dia").value = str;		
		});  		
	});	

</script>