<div>
				
				<?php echo $this->Form->create('User'); ?>	

				<fieldset>
						<legend>Registration</legend>
		
						<?php 
								echo $this->Form->input('name');
								echo $this->Form->input('email');
								echo $this->Form->input('password');
								echo $this->Form->input('password_confirmation',array('type' => 'password'));
						?>

				</fieldset>

				<?php echo $this->Form->end('Register'); ?>


</div>
