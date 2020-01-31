<h2>Login</h2>
<?php 
				echo $this->Form->create('User');
				echo $this->Form->input('email');
				echo $this->Form->input('password');
				echo $this->Form->end('Login');

			

				echo $this->Html->link('No account yet, click here to register ',array('action' => 'register'));

?>


