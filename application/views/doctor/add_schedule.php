<section>
		
	<header class="major">
		<h2>Selecciona un doctor</h2>
		<p>
			<select id="opt" >
			<option value=""></option>
			<?php foreach ($docs as $doc): ?>
				<option class="valor" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['ape']?></option>
			<?php endforeach; ?>			
			</select>
		</p>
	</header>
	<section id="horario" style="display: none;"><!--section.form start-->
		<h1><?php echo $title; ?></h1>
		<form method="POST" action="<?php echo base_url(); ?>index.php/Horario/crear_nuevo">
			<input type="hidden" value="" name="cvedoc" id="idDoc"></input>
			<div class="row uniform 50%">
				<!-- trabajando con los horarios -->
				<div class="12u 12u$(xsmall)">
					<h4>Horarios de atención de: </h4>
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
							<tbody id="cpi">
							</tbody>
						</table>
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
	</section><!--section.from end-->
</section>

<script type="text/javascript">

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
				console.log(data.edo);
				if(data.edo == false){
					vals();
				}else{
					alert('este usuario ya tiene horario');
				}
			}).fail(function() {
    			console.log( "error" );
  			});			
		}else{
			$('#horario').hide();
			$('#cpi').html("");
		}
  	});
  	function vals(){
  		var dis = ["lunes", "martes", "miercoles","jueves","viernes","sabado"];
  		var str = "";
  		for (var i = 0; i < dis.length; i++) {
			str += "<tr id="+(i+1)+">"
			str += "<td>"+dis[i]+"</td>"
			str += '<td>';
			str += '<input class="" name="ini_'+(i+1)+'" id="ini_'+(i+1)+'" type="time" min="09:00" max="20:00" value="09:00">';
			str += '<a class="button small" onclick="setSiguiente('+(i+1)+');">Ok</a>';
			str += '</td>';
			str += '<td><input name="fin_'+(i+1)+'" id="fin_'+(i+1)+'" type="time" min="10:00" max="21:00" disabled = "disabled" value="10:00">'
			str += '<a class="button small" onclick="guardar('+(i+1)+');">Ok</a>';
			str += '</td>';
			str += "</tr>";  
  		}
  		$('#cpi').html(str);
  		$('#horario').show();

  	}
  	function setSiguiente(val){
  		var vl = $('#ini_'+val).val();
  		var arg = vl.split(':');
  		var d = new Date();
  		d.setHours(arg[0]);
  		d.setMinutes(arg[1]);
  		d.setSeconds(00);
  		var edo = true;
  		if(d.getHours() > 20 || d.getHours() < 9){
  			edo = false;
  			$('#ini_'+val).css("border-color", "red");
  		}else{
  			$('#ini_'+val).css("border-color", "green");
  		}
  		//lemagregamos una hora al input:time#fin
  		var daux = d;
  		d.setHours(d.getHours() + 1);
  		//Cambiamos la hora que muestra
  		var str = d.toLocaleTimeString();
  		if(str.length == 7){
  			str = '0'+str;
  		}
  		$('#fin_'+val).val(str);
  		if(edo){
  			$('#fin_'+val).attr("disabled",false);
  		}else{
  			$('#fin_'+val).attr("disabled",true);
  			alert("Hora de inicio no valida.");
  		}

  	}
  	function guardar(val){
  		var vl = $('#fin_'+val).val();
  		var arg = vl.split(':');
  		var dfin = new Date();
  		dfin.setHours(arg[0]);
  		dfin.setMinutes(arg[1]);
  		dfin.setSeconds(00);

  		vl = $('#ini_'+val).val();
  		arg = vl.split(':');
  		var dini = new Date();
  		dini.setHours(arg[0]);
  		dini.setMinutes(arg[1]);
  		dini.setSeconds(00);  		

  		if(dfin.getHours() > dini.getHours() && dfin.getHours() <= 21){
  			$('#fin_'+val).css("border-color", "green");
  		}else{
  			$('#fin_'+val).css("border-color", "red");
  		}
  	}

</script>