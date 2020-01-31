<div class='users' style="width:60%;margin:0 auto">

                <?php echo $this->Form->create('User'); ?>	

                <fieldset>
						<legend>Change Password</legend>
		
                        <?php 
                                echo $this->Form->input('old_password',array('type' => 'password','label' => 'Current Password'));
								echo $this->Form->input('password');
								echo $this->Form->input('password_confirmation',array('type' => 'password'));
						?>

				</fieldset>

				<?php echo $this->Form->end('Change Password'); ?>






</div>