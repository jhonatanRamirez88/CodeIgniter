<section>
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>	
					<th>Nombre doctor</th>
					<th>Nombre usuario</th>
					<th>Fecha cita</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$indice = 0;
					foreach ($reporte as $item ): 
				?>
					<tr>
						<td ><?php echo $item['nomdoc']; ?></td>
						<td ><?php echo $item['nomusu']; ?></td>
						<td ><?php echo $item['fecha']; ?></td>
					</tr>	
				
				<?php endforeach; ?>


			</tbody>
		</table>
	</div>
</section>


