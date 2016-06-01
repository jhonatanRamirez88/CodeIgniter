<section>	
	<header class="major">
<<<<<<< Updated upstream
		<h2>Crear horario del doctor</h2>
			<h1>Selecciona un doctor:</h1>
			<select id="opt">
			<option value=""></option>
				<?php foreach ($docs as $doc): ?>
					<option class="valor" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['ape']?></option>
				<?php endforeach; ?>
			</select>
			<br>
			<h1>Selecciona un dia:</h1>
			<select id="opt1" disabled>
				<option value=""></option>
				<?php foreach ($dias as $dia): ?>
					<option class="" value="<?php echo $dia['cve']?>"><?php echo $dia['descripcion']?></option>
				<?php endforeach; ?>				
=======
		<h2>Selecciona un doctor</h2>
		<p>
			<select id="opt" >
				<option value=""></option>
				<?php foreach ($docs as $doc): ?>
					<?php  $var = $doc['nom']." ".$doc['ape']; ?>
					<option class="valor" value="<?php echo $doc['cdoc']?>"><?php echo $var ?></option>
				<?php endforeach; ?>			
>>>>>>> Stashed changes
			</select>
	</header>
	
	<section id="horario" style="display: none;"><!--section.form start-->
<<<<<<< Updated upstream
		<h1>Horario</h1>
=======
		<h1>Asociar horario de atención</h1>
>>>>>>> Stashed changes
		<form id="fro" method="POST" action="<?php echo base_url(); ?>index.php/Horario/crear_nuevo">
			<input type="hidden" value="" name="cvedoc" id="idDoc"></input>
			<div class="row uniform 50%">
				<!-- trabajando con los horarios -->
				<div class="12u 12u$(xsmall)">
					<h4>Defina el horario:</h4>
				</div>
				<div class="12u 12u$(xsmall)">
					<div class="table-wrapper">
						<table>
							<thead>
								<tr>
									<th>Dia</th>
									<th>Inicio (min: 9 am)</th>
									<th>Final (max: 9 pm)</th>
								</tr>
							</thead>				
							<tbody id="rowstable">
							</tbody>
						</table>
					</div>
				</div>
				<span></span>
				<div class="12u 12u$(xsmall)">
					<ul class="actions">
						<li><input type="submit" value="Guardar" class="special" /></li>
						<li><input type="reset" value="Limpiar" class=""/></li>
					</ul>		
				</div>
			</div>
		</form>
	</section><!--section.from end-->
</section>

<script type="text/javascript">
<<<<<<< Updated upstream
	
	$( "#opt" ).change(function () {
		//console.log('holo');
		var x = $(this).find(":selected").val();
		$('#idDoc').val(x);//Cambiamos el valor del hidden para mandarlo en el usuario.
		if(x != ""){//validacion de que no sea el primer elemento.
			$('#opt1').attr('disabled',false);
		}else{
			$('#opt1').attr('disabled',true);//desabilitamos el select
			$('#horario').hide();//Ocultamos la tabla de horario.
			$('#rowstable').html("");//Eliminamos las filas que tiene esa tabla
		}
	});	

	$( "#opt1" ).change(function (){
		var valopt = $(this).find(":selected").val();
		if(valopt != ""){
			var strdia = $(this).find(":selected").html();
			var row = "<tr>";
			row += "<td>"+strdia+"</td>";
			//Hora de inicio
			row += '<td>';
			row += '<input class="validar ini" name="ini_'+valopt+'" id="ini_'+valopt+'" type="time" min="09:00" max="20:00" value="09:00" onchange="validarInicio('+valopt+')" requiered >';
			row += '</td>';
			//Hora de fin		
			row += '<td>';
			row += '<input class="validar fin" name="fin_'+valopt+'" id="fin_'+valopt+'" type="time" min="10:00" max="21:00" value="21:00" requiered>';
			row += '</td>';			
			row += "</tr>";
			//Eliminamos la opcion seleccionada del item SELECT
			$("#opt1 option:selected").remove();

			$('#rowstable').append(row);
			$('#horario').show();
=======

	$(document).ready(function() {
		$( "#opt" ).change(function () {
			var x = $(this).find(":selected").val();
			$('#idDoc').val(x);
			if(x != ""){//validacion de que no sea el primer elemento.
				$.ajax({
				  method: "GET",
				  url: "<?php echo base_url();?>index.php/Horario/get_horario_cve",
				  data: {cve_doc:x}
				}).done(function( data ) {
					data = JSON.parse(data);
					if(data.edo == false){
						vals();
					}else{
>>>>>>> Stashed changes

			if (strdia.toLowerCase() == "sabado") {//Para el dia sabado tiene diferentes horarios de atencion.
				$('#ini_'+valopt).attr('max','13:00');
				$('#fin_'+valopt).attr('max','14:00');
				$('#fin_'+valopt).val('14:00');
			}			
		}
	});
	/*Permite modificar el attr min del elemento fin*/
	function validarInicio(num){
		var ini = "#ini_"+num;//Id de inicio
		var fin = "#fin_"+num;//Id de fin
		var hr = $(ini).val();//Valor que tiene el elemento de inicio
		var time = new Date();//Creamos una fecha
		hr = hr.split(':');
		num = conv(hr[0]);
		time.setHours(num + 1);
		time.setMinutes(0);
		time.setSeconds(0);
		var t = (time.toTimeString().split(" "))[0];
		//console.log(t);
		$(fin).attr('min', t);
		$(fin).val(t);
	}
	/*Conversion de un str de hora a un int*/
	function conv(str){
		var num = -1;
		if(str[0] == "0" ){
			if(str == "00"){
				num = 12;
			}else{
				num = parseInt(str[1]);
			}
		}else{
			num = parseInt(str);
		}
		return num;
	}
</script>