			<section>
				<h1><?php echo $title; ?></h1>		
<div class="table-wrapper">
	<table>
		<thead>
			<tr>	
				<th>Clave</th>
				<th>Descripcion</th>
				<th>Actualizar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$indice = 0;
				foreach ($data as $item ): 
				?>
				<tr id="row<?php echo $item['cve']; ?>">
					<td><?php echo $indice+=1; ?></td>
					<td id="tddesc<?php echo $item['cve']; ?>"><?php echo $item['descripcion']; ?></td>
					<td id="btnRe<?php echo $item['cve']; ?>">
						<input value="Actualizar" class="btn" id="aceptar_<?php echo $item['cve']; ?>" type="button" />
					</td>
					<td> <input value = "Borrar" type="button" onclick="alertDelete(<?php echo $item['cve']; ?>);"/></td>
				</tr>	
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
</section>
<script type="text/javascript">
	var idReplace = "";
	var part;
	$( "input.btn" ).click(function() {
	    var btnId = jQuery(this).attr("id");
	    part = btnId.split('_');
	    var idReplace = 'tddesc'+part[1];//reemplazar el contedifo del <td>
	    var cont = $('td#'+idReplace).html();//Contenido del <tdata>
	    var code = '<input type="text" id="desc'+part[1]+'" value="'+cont+'" placeholder="Nuevo nombre" />';
	    $('#'+idReplace).html(code);//
	    //TERMINA EL REMPLAZO
	    code = '﻿﻿﻿﻿<input value="Aceptar"  class="btn_aceptar" id="'+btnId+'" type="button" onclick="openAlert('+part[1]+');"/>';
	    $('#btnRe'+part[1]).html(code);


	});
	function openAlert(cve){
	    if (confirm("¿Desas hacer el cambio?") == true) {
	        location.href="<?php echo base_url();?>index.php/Especialidad/upLic/"+cve+"/"+$('input#desc'+cve).val();;
	    }
	}
	function alertDelete(cve){
	    if (confirm("¿Desas hacer el cambio?") == true) {
	        location.href="<?php echo base_url();?>index.php/Especialidad/deLic/"+cve;
	    }
	}
</script>
