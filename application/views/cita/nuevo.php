<section>
		
		<form method="POST" action="<?php echo base_url(); ?>index.php/Cita/recibirVerNuevo">
			<div class="row uniform 50%">
				<div class="4u 12u$(xsmall)">
				Selecciona un paciente
					<div class="select-wrapper">
								<select id="paciente" >
								<option value=""></option>
								<?php foreach ($paciente as $pac): ?>
									<option class="valor" value="<?php echo $pac['cve']?>"><?php echo $pac['nombre']?> <?php echo $pac['appat']?> <?php echo $pac['apmat']?></option>
								<?php endforeach; ?>			
								</select>
					</div>
				</div>



				<div class="4u 12u$(xsmall)">
				Selecciona un doctor
					<div class="select-wrapper">
						<select id="doctor" >
						<option value=""></option>
						<?php foreach ($pollo as $doc): ?>
							<option class="valor" value="<?php echo $doc['cdoc']?>"><?php echo $doc['nom']?> <?php echo $doc['ape']?></option>
						<?php endforeach; ?>			
						</select>
					</div><!-- termina el div select wrapper-->
				</div>

		<div class="4u 12u$(xsmall)">
			Horario elegido disponible:<input name="telmov" type="tel"></input>
		</div>


		<div class="4u 12u$(xsmall)">
			Fecha elegida:<input name="telmov" type="tel"></input>
		</div>




				<!-- parte de los botones-->
				<div class="12u 12u$(xsmall)">
					<ul class="actions">
						<li><input type="submit" value="Guardar" class="special" /></li>
						<li><input type="reset" value="Limpiar" /></li>
					</ul>		
				</div>
			</div>
		</form>
</section>

