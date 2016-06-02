<section>
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>	
					<th>#</th>
					<th>Paciente</th>
					<th>Cita</th>
					<th>-</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$indice = 0;
					foreach ($citas as $item ): 
					?>
					<tr id="">
						<td><?php echo $indice+=1; ?></td>
						<td id=""><?php echo $item['paciente']." ".$item['pat']; ?></td>
						<td id=""><?php echo $item['hora']; ?></td>
						<td id="btn">
							<input value="Atender" onclick="atender(<?php echo $item['cvepac']; ?>,<?php echo $item['cvecita']; ?>)" type="button" />
						</td>
					</tr>	
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>
<script type="text/javascript">
	function atender(cve,cvecita){
	    location.href="<?php echo base_url();?>index.php/Historial/get_paciente/"+cve+"/"+cvecita;
	}
</script>
