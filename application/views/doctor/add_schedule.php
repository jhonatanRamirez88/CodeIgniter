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
		<form id="fro" method="POST" action="<?php echo base_url(); ?>index.php/Horario/crear_nuevo">
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
						<li><input type="submit" value="Guardar" class="special asd" /></li>
						<li><input type="reset" value="Limpiar" class="asd"/></li>
					</ul>		
				</div>
			</div>
		</form>
	</section><!--section.from end-->
</section>

<script type="text/javascript">
	/*
	$(".clasefin").change(function (){
  		var ide = this.id;
  		console.log(ide);
  	});
  	*/

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

						var res =  crearHorarioExistente(data);
						$('form').get(0).setAttribute('action', '<?php echo base_url();?>index.php/Horario/update_horario');
						$('#cpi').html(res);//cambaimos el contenido de la tabla
						$('.asd').toggle();//ocultamos los botones del form
	  					$('#horario').show();//Mostramos la tabla
	  					
					}
				}).fail(function() {
	    			console.log( "error" );
	  			});			
			}else{
				$('#horario').hide();
				$('#cpi').html("");
			}

	  	});	
    });

  	function vals(){
  		var dis = ["lunes", "martes", "miercoles","jueves","viernes","sabado"];
  		var str = "";
  		for (var i = 0; i < dis.length; i++) {
			str += "<tr id="+(i+1)+">"
			str += "<td>"+dis[i]+"</td>"
			str += '<td>';
			str += '<input class="" name="ini_'+(i+1)+'" id="ini_'+(i+1)+'" type="time" min="09:00" max="20:00" value="09:00" requiered readonly>';
			str += '<a class="button small" onclick="setSiguiente('+(i+1)+');">Ok</a>';
			str += '</td>';
			str += '<td><input name="fin_'+(i+1)+'" id="fin_'+(i+1)+'" type="time" min="10:00" max="21:00" readonly value="10:00" requiered>'
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
  		$('#fin_'+val).attr('min', str);//modificamos el minimo que puede elegir en el fin de hora
  		$('#fin_'+val).val(str);//Modificamos el contenido a visulizar
  		if(edo){//desabilitar el sig hora
  			var str = 'fin_'+val;
  			$("#"+str).attr("readonly", false);
  		}else{
  			var str = 'fin_'+val;
  			$("#"+str).attr("readonly", true);  			
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

  	function crearHorarioExistente(data){
  		var str ="";
		var ind;
		for (ind in data) {
			var row = data[ind];//cdia, ddia, ini, fin
			str += "<tr id="+row.cdia+" class="+"fila"+">"
			str += "<td>"+row.ddia+"</td>"
			str += '<td>';
			str += '<input onclick="editarElemento(this.id)" class="clase01" name="ini_'+row.cdia+'" id="ini_'+row.cdia+'" type="time" min="09:00" max="20:00" value="'+row.ini+'" readonly>';
			str += '</td>';
			str += '<td><input onclick="editarElemento(this.id)" class="clasefin" name="fin_'+row.cdia+'" id="fin_'+row.cdia+'" type="time" min="10:00" max="21:00" value="'+row.fin+'" readonly>'
			str += '</td>';
			str += "</tr>";
		}
		return str;
  	}

	function editarElemento(ide){
		var rea = $('#'+ide).attr("readonly");
		if(rea == "readonly"){
	       	$("#"+ide).attr("readonly", false);
	       	$(".asd").show();
	    }
		var ini = ide.replace('fin','ini');
	    if(ide.includes('fin')){
	    	var bob = $('#'+ini).val();
	    	var d = new Date();
	    	var spt = bob.split(':');

	    	d.setHours(spt[0]);
	    	d.setMinutes(spt[1]);
	    	d.setSeconds('00');
	    	d.setHours(d.getHours() + 1);
	    	bob = d.toLocaleTimeString();
	    	console.log(bob);
	    	if(bob.length == 7){
	    		bob = '0'+ d.toLocaleTimeString();
	    	}
	    	$('#'+ide).attr("min",bob);
	    	$('#'+ide).val(bob);
	    }

  	} 

  	function verificaReadOnlyDesactivar(ide){
  		var rea = $('#'+ide).attr("readonly");
  		var edo = false;
		if(rea == "readonly"){
	       	$("#"+ide).attr("readonly", false);
	       	edo = true;
	    }
	    return edo;
  	}
  	
</script>