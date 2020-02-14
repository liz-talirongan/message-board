<?php foreach ($message_list as $message): ?>
							<li 
								style="height:auto;width:70%;border:1px solid black;margin-top:1%;
									margin-bottom:1%;display:inline-block;margin-left:0px;margin-right:0px"
								class="messageDiv" fade-id="<?php echo $message['Message']['id'] ?>"
							>
									<?php $sLength = strlen($message['Message']['content']); ?>

									<?php if($message['Message']['from_id'] == AuthComponent::user('id')): ?>

														<img class="img_btn" data-id="<?php echo $message['Message']['from_id'] ?>" 
															src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['SenderJoin']['simage'] ?>"  
															style="width:100px;height: 100px;float:left;"
														/> 

														<p 
															style="margin:3%;display:inline-block;width:inherit;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"
															class="message_div" 
															fad-id="<?php echo $message['Message']['id'] ?>"
														>
															<?php echo $message['Message']['content']; ?>

															<br>
															
															

															<?php if ($sLength > 300): ?>

																<a class="more" href="#"  data-id="<?php echo $message['Message']['id'] ?>">Read More</a>
																<a class="less" href="#"  style="display:none;" data-id="<?php echo $message['Message']['id'] ?>">Show less</a>

															<?php endif; ?>

														</p>

														<hr>

														<span style="text-align:right;margin-right:10px;float:right;margin-top:1.5%;">
															<?php 
																echo date("Y/m/d H:i a", strtotime($message['Message']['created'])); 
															?>
														</span>

														<button 
																class="btn_user_sender" 
																data-id="<?php echo $message['Message']['id'] ?>"
																style="display:inline-block;margin-left:2%;margin-top:1.5%;margin-bottom: 1%;"
														>
																Delete Message 
														</button>

									<?php else: ?>
														<img class="img_btn" data-id="<?php echo $message['SenderJoin']['sid'] ?>" 
															src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['SenderJoin']['simage'] ?>"  
															style="width:100px;height: 100px;float:right;"
														/> 

														<p 
															style="margin-top:3%;display:inline-block;width:inherit;text-align:right;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"
															class="message_div" 
															receiver-id="<?php echo $message['UserJoin']['rid'] ?>"
															sender-id="<?php echo $message['SenderJoin']['sid'] ?>"	
														>
															<?php echo $message['Message']['content']; ?>



															<?php if ($sLength > 300): ?>

																	<a class="more" href="#"  data-id="<?php echo $message['Message']['id'] ?>" style="text-align:left;display:block;margin:3%;">Read More</a>
															



															<?php endif; ?>

														</p>


														<hr>

														<span style="text-align:left;margin-left:10px;float:left;margin-top:1.5%;">
															<?php 
																echo date("Y/m/d H:i a", strtotime($message['Message']['created'])); 
															?>
														</span>

														<button 
																class="btn_user_sender" 
																data-id="<?php echo $message['Message']['id'] ?>"
																style="display:inline-block;margin-right:2%;margin-top:1.5%;float:right;margin-bottom: 1%"
														>
																Delete Message 
														</button>

									<?php endif ?>
								
							</li>

<?php endforeach; ?>