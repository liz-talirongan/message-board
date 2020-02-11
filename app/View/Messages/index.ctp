<?php 

			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

			echo $this->Html->script('https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js');


?>


 <?php $arraySize = sizeof($messages_list_all); ?>

<input type="hidden" value="<?php echo $arraySize ?>" id="arrSize">

<div class="users messageDivParent">

				<h2>Message List</h2>

				<p class="newMessageLinkBtn">
								<?php echo $this->Html->link("New Message", array('action' => 'newMessage')); ?>
				</p>
				<ul  id="messageLists">
					<?php foreach ($messages_list as $message): ?>

								<li class="liMessageList"  data-id="<?php echo $message['Message']['id'] ?>" >


												<?php if($message['Message']['from_id'] == AuthComponent::user('id')): ?>

														<img class="img_btn listImageLeft" data-id="<?php echo $message['UserJoin']['rid'] ?>" 
															src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['UserJoin']['rimage'] ?>"  

														/> 

														
												<?php else: ?>

														<img class="img_btn" data-id="<?php echo $message['SenderJoin']['sid'] ?>" 
															src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['SenderJoin']['simage'] ?>"  
															style="width:100px;height: 100px;float:left;"
														/> 

												<?php  endif; ?>



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

				</ul>

				
			    <?php if ($arraySize > 4): ?>
			
					<div class="divShowMoreBtn">				
							<a href="#" id="btn-showMore">Show more</a>
					</div>


				<?php endif; ?>

				<img src="<?php echo $this->webroot; ?>/img/empty.png"   style="display:none;" id="emptyImage"/> 



				<div class="divNoMoreMessageLoad">
								
					<p id="showError" style="color:red;">NO MORE CONVERSATION TO LOAD !</p>

				</div>

				<input type="hidden" id="startSql" value="4">

				<input type="hidden" id="authId" value="<?php echo $userId; ?>">



				<div id='errorShowMessage' class="erroShowMessageDiv"></div>
				

</div>



<script type="text/javascript">




				$(document).ready(function () {


								var start = parseInt($('#startSql').val());

								var arraySize = parseInt($('#arrSize').val());

								var limit = 10;

								if(arraySize == 0){

									$('#emptyImage').css({
										'display':'block'
									})
								}


								$("#messageLists").on('click','.img_btn',function() {

												var user_id = $(this).attr('data-id');

												document.location.href = "/MessageBoard/users/profile/" + user_id;
								});



			

								$("#messageLists").on('click','.message_div',function() {

												var receiver_id = $(this).attr('receiver-id');

												var sender_id = $(this).attr('sender-id');

												document.location.href = "/MessageBoard/messages/messageDetails/" + receiver_id + "/" + sender_id;

								
								});



								$("#messageLists").on('click','.btn_user_sender',function() {

												var messageId = $(this).attr('data-id');

												var receiver_id = $(this).attr('receiver-id');

										 		var sender_id = $(this).attr('sender-id');

												$.ajax({
													url:'/MessageBoard/messages/deleteConversation',
													type:'POST',
													data:{
												      "receiverId":receiver_id,
												      "senderId":sender_id
												    },
												 	success:function(data)  
											        {  	

													        	var searchDiv = $("div").find("[data-id='" + messageId + "']"); 

													        	arraySize = arraySize - 1;

													        	if(arraySize == 0){

																    $('#emptyImage').css({
																		'display':'block'
																	})
													        	}

													        	

													        	searchDiv.fadeOut();

											        }  
												});

								});


								$('#btn-showMore').on('click',function(){

						
									  var authId = $('#authId').val();


										$.ajax({
											url:'/MessageBoard/messages/loadMoreConversation',
					                          type:'POST',
					                          dataType: 'JSON',
					                          data: {
					                            "start":start,
					                            "limit":limit
					                          },
											  success:function(response){
												
												  var responseLength = response.length;

												  console.log("reponse");

												  console.log(response);

												  start = start + limit;

												  $('#startSql').val(start);


												  if (responseLength == 0){
															$('div #btn-showMore').css({
																'display':'none'
															});

															$(errorShowMessage).append('<p style="display:block">No more message conversation to load! </p>');
												  }

												  

												  for(var i = 0; i < responseLength ; i++){

													  var str = "";

													  if (response[i].Message.from_id == authId){



														 str = str + 

														 '<li class="liMessageList" data-id="' + response[i].Message.id + '"' + '>' + 
															
															'<img class="img_btn listImageLeft" data-id="' + response[i].UserJoin.rid + '"' + 
															' src="/MessageBoard/img/profile/' + response[i].UserJoin.rimage + '" style="width:100px;height:100px;float:left;">' +

															'<p class="message_div contentParagraphLeft"' + ' receiver-id="' + response[i].UserJoin.rid + '"' + ' sender-id="' + response[i].SenderJoin.sid + '">' + response[i].Message.content + '</p>' + 

															'<hr>' + '<span class="spanLeft">' + 

															response[i].Message.created + '</span>' + 

															'<button class="btn_user_sender btnDeleteMessageLeft" ' + 
															' data-id="' + response[i].Message.id + '"' +  ' receiver-id="' + response[i].UserJoin.rid + '"' +
															' sender-id="' + response[i].SenderJoin.sid + '"' + '>' +
															'Delete Conversation' + '</button>'


															+ '</li>';			
											
													  }else{

													  		
													  		str = str + 

														 '<li class="liMessageList" data-id="' + response[i].Message.id + '"' + '>' 



														 	+ 
															
															'<img class="img_btn listImageLeft" data-id="' + response[i].SenderJoin.sid + '"' + 
															' src="/MessageBoard/img/profile/' + response[i].SenderJoin.simage + '" >' +

															'<p  class="message_div contentParagraphLeft"' + ' receiver-id="' + response[i].UserJoin.rid + '"' + ' sender-id="' + response[i].SenderJoin.sid + '">' + response[i].Message.content + '</p>' + 

															'<hr>' + '<span style="text-align:right;margin-right:10px;float:right;margin-top:1.5%;">' + 

															response[i].Message.created + '</span>' + 

															'<button class="btn_user_sender" ' + 
															' data-id="' + response[i].Message.id + '"' +  ' receiver-id="' + response[i].UserJoin.rid + '"' +
															' sender-id="' + response[i].SenderJoin.sid + '"' + 'style="display:inline-block;margin-left:2%;margin-top:1.5%;margin-bottom:1%;">' +
															'Delete Conversation' + '</button>'


															+ '</li>';		

													  }
												

													  $("#messageLists").append(str);

												
												  }

											  }
										});	

								});


				});


</script>


