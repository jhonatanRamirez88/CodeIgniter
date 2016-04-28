<section>

	<form method="POST" action="<?php echo base_url(); ?>index.php/Cita/buscar">						
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona el día
					<div class="select-wrapper">
						<select id="horario" >
						<option value=""></option>
						<?php foreach ($horas as $doc): ?>
							<option class="valor" value="<?php echo $doc['cve']?>"><?php echo $doc['descripcion']?></option>
						<?php endforeach; ?>			
						</select>
					</div><!-- termina el div select wrapper-->
				</div>


			</div>



<div class="row uniform 50%">
			<div class="5u 12u$(xsmall)">
			<ul class="actions">
				<li><input type="submit" value="Buscar" class="special" /></li>		
			</ul>
			</div>
</div>


	</form>
</section>