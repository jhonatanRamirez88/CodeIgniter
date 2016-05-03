<section>
	<h1><?php echo $title; 
		?></h1>		

	<form method="POST" action="<?php echo base_url(); ?>index.php/cita/executeUpdate">
		<div class="row uniform 50%">
			<input type="hidden"></input>
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
					<li><input type="submit" value="Guardar" class="special" id="btn1" disabled/></li>
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
		$('#btn1').attr('disabled', false);
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
			var str = "";
			if(data[0] == false){
				str += '<option value="">No hay horarios.</option>';
				$('#btn1').attr('disabled', true);
			}else{
				for(var i = 0; i < data[0].length; i++){
					var aux = data[0][i];
					if(aux.length == 1){
	 					aux = '0'+aux+":00"
					}else{
						aux = aux+":00"
					}
					str += '<option value='+aux+'>'+aux+'</option>';
				}
				$('#btn1').attr('disabled', false);
			}
			$('#hora').html(str);				
		});  		
	});	

</script>