<section>
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>	
					<th>#</th>
					<th>Nombre</th>
					<th>Apellido paternor</th>
					<th>Telefono</th>
					<th>Actualizar</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$indice = 0;
					foreach ($data as $item ): 
					?>
					<tr id="row<?php echo $item['cve_usu']; ?>">
						<td><?php echo $indice+=1; ?></td>
						<td id=""><?php echo $item['nom']; ?></td>
						<td id=""><?php echo $item['pat']; ?></td>
						<td id=""><?php echo $item['telpar']; ?></td>
						<td id="">
							<input value="Actualizar" onclick="alertUpdate(<?php echo $item['cve_usu']; ?>)" type="button" />
						</td>
					</tr>	
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
<script type="text/javascript">
	function alertUpdate(cve){
	    location.href="<?php echo base_url();?>index.php/Paciente/verUpdate/"+cve;
	}

</script>
