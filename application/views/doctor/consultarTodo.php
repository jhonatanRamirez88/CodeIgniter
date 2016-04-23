<section>
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>	
					<th>Clave</th>
					<th>Nombre</th>
					<th>Apellido paternor</th>
					<th>Apellido materno</th>
					<th>Actualizar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$indice = 0;
					foreach ($datos as $item ): 
					?>
					<tr id="row<?php echo $item['cve']; ?>">
						<td><?php echo $indice+=1; ?></td>
						<td id="tddesc<?php echo $item['cve']; ?>"><?php echo $item['nombre']; ?></td>
						<td id="tddesc<?php echo $item['cve']; ?>"><?php echo $item['ap_paterno']; ?></td>
						<td id="tddesc<?php echo $item['cve']; ?>"><?php echo $item['ap_materno']; ?></td>
						<td id="btnRe<?php echo $item['cve']; ?>">
							<input value="Actualizar" onclick="alertUpdate(<?php echo $item['cve']; ?>)" type="button" />
						</td>
						<td> <input value = "Borrar" type="button" onclick="alertDelete(<?php echo $item['cve']; ?>);"/></td>
					</tr>	
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
<script type="text/javascript">
	function alertUpdate(cve){
	    location.href="<?php echo base_url();?>index.php/Doctor/verUpdateConsulta/"+cve;
	}
	function alertDelete(cve){
	    if (confirm("¿Desas hacer eliminar este campo?") == true) {
	        location.href="<?php echo base_url();?>index.php/Doctor/delete_doctor/"+cve;
	    }
	}
</script>
