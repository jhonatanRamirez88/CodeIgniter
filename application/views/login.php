<section>
		<h1>Login de usuarios</h1>
		<form method="POST" action="<?php echo base_url(); ?>index.php/Login/login">

		<div class="4u 12u$(xsmall)">
			Usuario:<input name="usuario" type="text"></input>
		</div>

		<div class="4u 12u$(xsmall)">
			Password:<input name="pass" type="password"></input>
		</div>
		<br>
		<br>
				<!-- parte de los botones-->
				<div class="12u 12u$(xsmall)">
					<ul class="actions">
						<li><input type="submit" value="Login" class="special" /></li>
					</ul>		
				</div>
			</div>
		</form>
</section>