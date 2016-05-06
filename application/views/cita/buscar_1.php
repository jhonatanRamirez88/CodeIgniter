<section>
<!--//cve(cveusu,nombre(nombre usu), ap_paterno,ap_materno order by cve)-->
	<form method="POST" action="<?php echo base_url(); ?>index.php/Cita/citas_2">
			
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona un paciente:
					<div class="select-wrapper">
						<select name="paciente" >
						<option value=""></option>
						<?php foreach ($usuario as $doc):  ?>
							<option class="valor" value="<?php echo $doc['cve']?>"><?php echo $doc['nombre']?> <?php echo $doc['appat']?></option>
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