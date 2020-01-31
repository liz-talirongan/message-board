<?php 

      echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

 
?>

<?php $arraySize = sizeof($messages_list_all); ?>

<div id='errorMessage' style="color:red;font-size:18px;"></div>

<div class='users'>

	<h2>Message Detail</h2>

	<div style='float:right'>

					<input type="hidden" value="<?php echo $meid ?>" id='receiver_id'>

					<textarea id="replyMessage" placeholder='Message' style='width:500px;'></textarea> 

					<button id="btn_to_submit">Reply Message </button>

	</div>

	<div style="clear:both;display:table;"></div>

	<div style="width:70%;margin:0 auto;margin-top:2%;" >

					<ul style="list-style-type:none" id="userLists">

						<?php foreach ($messages_list as $message): ?>
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

																<a class="more" href="#"  data-id="<?php echo $message['Message']['id'] ?>">Read more </a>
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

																	<a class="more" href="#"  data-id="<?php echo $message['Message']['id'] ?>" style="text-align:left;display:block;margin:3%;">Read more
																	 </a>
															



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


					</ul>

					<?php if ($arraySize > 4): ?>
							<div style="margin:0 auto;width:70%;display:block;">
										
										<a href="#" id="btn-showMore" style="display:block;">Show more</a>
							</div>
					<?php endif; ?>

					

	</div>

	<div id='errorShowMessage' style="color:red;font-size:18px;margin:0 auto;width:70%;display:block;"></div>

	<input type="hidden" id="startSql" value="4">


</div>






<script type='text/javascript'>


	$(document).ready(function () {


					var start = parseInt($('#startSql').val());

					var limit = 10;

					$("#btn_to_submit").on('click',function() {

									var message = $('#replyMessage').val(); 
									var receiver = $('#receiver_id').val();

									if(message == "")
									{
										
										$(errorMessage).append('<p style="float:right;margin-right:10%;">Please input a reply message! </p>');

									}else{

										$.ajax({
												    url:'/MessageBoard/messages/replyMessage',
												    type:'POST',
												    data:{
												      "replyMessage":message,
												      "receiverId":receiver
												    },
												 	success:function(data)  
									                {  

									                	window.location.reload();
									                }  
										});
									}

					});


					 $("#btn-showMore").on('click',function() {

					 				var receiverId = $('#receiver_id').val();

							
									$.ajax({
												url:'/MessageBoard/messages/loadMoreMessageDetails',
												type:'POST',
												dataType: 'JSON',
												data: {
													"start":start,
													"limit":limit,
													"receiverId":receiverId
												},
												success:function(response)  
												{  
																var len = response.length;

															
																start = start + limit;	

													

																$('#startSql').val(start);

																if(len == 0){
																	$('div #btn-showMore').css({
																		'display':'none'
																	});

																	$(errorShowMessage).append('<p style="display:block">No more message to load! </p>');

																}

																for(var i =0 ; i < len ; i++){

																	var str = "";
																	var messageContent = response[i].Message.content;
																	var messageLength = messageContent.length;
																	var messageId = response[i].Message.id;

																	if (receiverId != response[i].Message.from_id){
																						str = str + 
																						'<li style="height:auto;width:70%;border:1px solid black;margin-top:1%;margin-bottom:1%;display:inline-block;margin-left:0px;margin-right:0px"'
																						+ 'class="messageDiv"' + 'fade-id="' + messageId + '">' +
																						'<img class="img_btn"' + "data-id='"+response[i].SenderJoin.sid+"'" + 

															

																						'src="/MessageBoard/img/profile/' + response[i].SenderJoin.simage + '" '  + 

																						"style='width:100px;height:100px;float:left;'>" + 

																						'<p style="margin:3%;display:inline-block;width:inherit;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" class="message_div"' + 

																						'fade-id="' + messageId + '">' + response[i].Message.content + '';


																						if(messageLength > 300){
																								str = str +  '<a class="more" href="#" ' + 
																								'data-id="' + messageId + '"' + ' style="text-align:left;display:block;margin:3%;"' + '> Read more..</a>';
																						}


																						str = str + '</p>';

																						str = str + 

																						'<hr>' + '<span style="text-align:right;margin-right:10px;float:right;margin-top:1.5%;">' + response[i].Message.created + '</span>' + 

																						'<button class="btn_user_sender"' + ' data-id="' + response[i].Message.id + '"' + 

																						'style="display:inline-block;margin-left:2%;margin-top:1.5%;margin-bottom:1%;">' + 'Delete Message </button>';

																						str = str + '</li>'


																	}else{
																		

																						str = str + 

																						'<li style="height:auto;width:70%;border:1px solid black;margin-top:1%;margin-bottom:1%;display:inline-block;margin-left:0px;margin-right:0px"'
																						+ 'class="messageDiv specialLiRight"' + 'fade-id="' + messageId + '">' +
																						'<img class="img_btn"' + "data-id='"+receiverId+"'" + 



																						'src="/MessageBoard/img/profile/' + response[i].SenderJoin.simage + '" '  + 

																						"style='width:100px;height:100px;float:right;'>" + 

																						'<p style="margin-top:3%;display:inline-block;width:inherit;text-align:right;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"class="message_div"' + 

																						'fade-id="' + messageId + '">' + response[i].Message.content + '</p>';

																						 if(messageLength > 300){

																							str = str +  '<a class="more" href="#" ' + 'data-id="' + messageId + '"' + 
																							' style="text-align:left;display:inline-block;margin:3%;"' + 
																							'> Read more..</a>';
																						 }


																						 str = str + 
																						 '<hr>' + '<span style="text-align:left;margin-left:10px;float:left;margin-top:1.5%;">' +
																						 	 response[i].Message.created + '</span>' + 
																						'<button class="btn_user_sender"' + ' data-id="' + response[i].Message.id + '"' + 

																						'style="display:inline-block;margin-right:2%;margin-top:1.5%;float:right;margin-bottom:1%;">' + 'Delete Message </button>'

																						str = str + '</li>';
																	}

																	$("#userLists").append(str);

																}


												}
																		
									});




			        });


	


					$("#userLists").on('click','.btn_user_sender',function(ev) {


					

									var message_id = $(this).attr('data-id');

									var searchDiv = $("div").find("[fade-id='" + message_id + "']"); 

									 $.ajax({
											url:'/MessageBoard/messages/deleteSingleMessage',
											    type:'POST',
											    data:{
										      "messageId":message_id,
										    },
										 	success:function(data)  
									        {  	
									        	searchDiv.fadeOut();
									           	//window.location.reload();
									        }  
									});
					});



		

					$("#userLists").on('click','.img_btn',function() {

									var user_id = $(this).attr('data-id');

									document.location.href = "/MessageBoard/users/profile/" + user_id;

					});



					$("#userLists").on('click','.more',function(e) {

					 				e.stopPropagation();
					
									var message_id = $(this).attr('data-id');

									var searchParagraph = $("div").find("[fade-id='" + message_id + "']"); 
								
									var searchBtn = $('a').find("[data-id='" + message_id + "']"); 

									searchParagraph.children('p').css({
								 		'height': 'auto',
								        //'width':'auto',
								        'overflow':'none',
								        'white-space':'normal',
										'display':'inline-block'
								 	})

									$(this).css({
									   'display':'none'
									});


									searchParagraph.children('p').click(function(){
										searchParagraph.children('p').css({
											 'height': '50px',
								        	//'width':'60%',
								        	'overflow':'hidden',
								        	'white-space':'nowrap'
										});


										$('.more').css({
										    'display':'block'
										 });
									});

					});



	});



	
</script>