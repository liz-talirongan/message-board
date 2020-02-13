<?php foreach ($message_list as $message): ?>

		<li class="liMessageList"  data-id="<?php echo $message['Message']['id'] ?>" >

				<?php if($message['Message']['from_id'] == AuthComponent::user('id')): ?>

							<img class="img_btn listImageLeft" data-id="<?php echo $message['UserJoin']['rid'] ?>" 
								src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['UserJoin']['rimage'] ?>"  /> 

				<?php else: ?>


							<img class="img_btn" data-id="<?php echo $message['SenderJoin']['sid'] ?>" 
								src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['SenderJoin']['simage'] ?>"  
								style="width:100px;height: 100px;float:left;"
							/> 

				<?php endif; ?>


				<p 
					class="message_div contentParagraphLeft" 
					receiver-id="<?php echo $message['UserJoin']['rid'] ?>"
					sender-id="<?php echo $message['SenderJoin']['sid'] ?>"	
				>
						<?php echo $message['Message']['content']; ?>
												
				</p>

				<hr>

				<span class="spanLeft">
					
					<?php 
						echo date("Y/m/d H:i a", strtotime($message['Message']['created'])); 
					?>
				</span>


				<button class="btn_user_sender btnDeleteMessageLeft"
						 data-id="<?php echo $message['Message']['id'] ?>" 
						 receiver-id="<?php echo $message['UserJoin']['rid'] ?>" 
						sender-id="<?php echo $message['SenderJoin']['sid'] ?>"
				>
						Delete Conversation 
				</button>

		</li>

		<li style="clear:both;"></li>

<?php endforeach; ?>