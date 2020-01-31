<?php 

			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

?>


<div class="users index" id="parentDiv">
	<h2>User Profile</h2>

	<input type="hidden" id="profId" value="<?php echo $profileId; ?>">

	<input type="hidden" id="usId" value="<?php echo AuthComponent::user('id') ?>">

	
	<div style="width:150px;height:150px;float:left">

			<img src="<?php echo $this->webroot; ?>img/profile/<?php echo $user['User']['image'] ?>"  style="max-width:150px;height:150px;">

	</div>

	<p style="margin-left:3%;float:left;line-height:2em;">

		<b style="font-size:18px">
			<?php 
				echo $user['User']['name'];
				


			?> 

			<?php echo  $age ?>

		</b>

		<br>

		Gender: <?php echo $gender; ?>

		<br>

		Birthdate: <?php echo date("F d, Y", strtotime($user['User']['birthdate']));?>
		<br>

		Joined: <?php echo date("F d, Y H:i a", strtotime($user['User']['created'])); ?>
		<br>
		Last Login: <?php echo date("F d, Y H:i a", strtotime($user['User']['last_login_time'])); ?>

	</p>

	<div style="clear:both;display:table;"></div>


	<p style="margin-top:3vh;width:60vw;lin">

		Hubby :

		<br><br>

		<?php echo $user['User']['hubby'] ?>

	</p>

 	



</div>

<?php if($profileId == AuthComponent::user('id')): ?>
	<div class="actions">

		
		<ul>
			<li><?php echo $this->Html->link('Edit Profile',array('action' => 'editProfile')) ?> </li>
			<li><?php echo $this->Html->link('Change Password',array('action' => 'changePassword')) ?> </li> 
		</ul>

	</div>
<?php endif; ?>

<script type="text/javascript">

	$(document).ready(function(){

		var access_profile_id = $('#profId').val();

		var loggUserId = $('#usId').val();

		if (access_profile_id != loggUserId){
			 
			$("#parentDiv").removeClass("index");
		}
	});

</script>


