<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Message Board
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		 //echo $this->Html->css('details');
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');


	?>

	
</head>
<body>
	<div id="container">

		<div id="header">
			<?php if($logged_in): ?>
				
				<p>
					<span style="float:right">
						Welcome <?php echo $current_user['name'];?>  , <?php echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout')) ?>
					</span>

					<span>
						<?php echo $this->Html->link('|PROFILE|',array('controller' => 'users','action' => 'profile',AuthComponent::user('id'))) ?>

						<?php echo $this->Html->link('|MESSAGES|',array('controller' => 'messages','action' => 'index')) ?>

					</span>

				</p>

			<?php else: ?>
				
				<p style="text-align:right">
					
					<?php echo $this->Html->link('Login',array('controller'=>'users','action'=>'login')) ?>

				</p>

			<?php endif; ?>
		</div>

			
		
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>

			<?php echo $this->Js->writeBuffer(); ?>
		</div>
	</div>
	
</body>
</html>
