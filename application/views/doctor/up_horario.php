<section>	
	<header class="major">
		<h2>Cambiar horario del doctor</h2>
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
			</select>
	</header>
	
	<section id="horario" style="display: none;"><!--section.form start-->
		<form id="fro" method="POST" action="<?php echo base_url(); ?>index.php/Horario/update_horario">
			<input type="hidden" value="" name="cvedoc" id="idDoc"></input>
			<div class="row uniform 50%">
				<!-- trabajando con los horarios -->
				<div class="12u 12u$(xsmall)">
					<h4>Actualizar horario de atención de: </h4>
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
	var aux = null;
	$('#opt').change(function (){
		var x = $(this).find(":selected").val();
		$('#idDoc').val(x);//Cambiamos el valor del hidden para mandarlo en el usuario.
		if($('#opt').val() != ""){
			cargarTabla();
			$('#opt1').attr('disabled',false);
			/*Llenamos el select con los dias faltantes, usar ajax
			mandar: this.val() =  cve del doctor,
			*/
			$.ajax({
			  method: "POST",
			  url: "<?php echo base_url();?>index.php/Doctor/dias_restantes",
			  data: { cve: $('#opt').val()}
			}).done(function( data ) {
				$('#opt1').html("<option value=''></option>");
				data = JSON.parse(data);	
				str = "";
				for (var i = 0; i < data.dias.length; i++) {
					str +=  "<option value="+data.dias[i].cve+">"
					str += data.dias[i].descripcion;
					str += "</option>";
				}
				$('#opt1').append(str);
			});
		}else{
			$('#opt1').html("<option value=''></option>");
			$('#opt1').attr('disabled',true);
			$('#rowstable').html("");
			$('#horario').hide();
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

			if (strdia.toLowerCase() == "sabado") {//Para el dia sabado tiene diferentes horarios de atencion.
				$('#ini_'+valopt).attr('max','13:00');
				$('#fin_'+valopt).attr('max','14:00');
				$('#fin_'+valopt).val('14:00');
			}			
		}
	});	

	function cargarTabla(){
		$.ajax({
			method: "POST",
			url: "<?php echo base_url();?>index.php/Doctor/dias_registrados",
			data: { cve: $('#opt').val()}
		}).done(function( data ) {
			$('#rowstable').html("");
			data = JSON.parse(data);
			data = data.regis;
			var row = "";
			for (var i = 0; i < data.length; i++) {
				var d = data[i].ddia;
				d = d.toString();
				row += "<tr id='"+data[i].ddia+"'>";
				row += "<td>"+data[i].ddia+"</td>";
				//Hora de inicio
				row += '<td>';
				row += '<input class="validar ini" name="ini_'+data[i].cdia+'" id="ini_'+data[i].cdia+'" type="time" min="09:00" max="20:00" value="'+data[i].ini+'" onchange="validarInicio('+data[i].cdia+')" requiered >';
				row += '</td>';
				//Hora de fin		
				row += '<td>';
				row += '<input class="validar fin" name="fin_'+data[i].cdia+'" id="fin_'+data[i].cdia+'" type="time" min="10:00" max="21:00" value="'+data[i].fin+'" requiered>';
				row += '<input value="Eliminar" class="btn" onclick="eliminarFila(\''+data[i].ddia+'\','+data[i].cdia+');" type="button">';
				row += '</td>';			
				row += "</tr>";				
			}
			$('#rowstable').html(row);
			$('#horario').show();
		});		
	}
	/*Eliminamos una fila de la tabla, se elimina un horario disponible y se agrega el
	dia al SELECT#OPT1*/
	function eliminarFila(ddia, cdia){
		//console.log(cdia);
		$('#'+ddia).remove();
		var ele = "<option value="+cdia+">"+ddia+"</option>"
		$('#opt1').append(ele);
	}
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