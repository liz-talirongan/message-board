<?php 

			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

			echo $this->Html->script('https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js');


?>


<!-- <?php echo sizeof($messages_list); ?>
 -->

 <?php $arraySize = sizeof($messages_list_all); ?>

 <input type="hidden" value="<?php echo $arraySize ?>" id="arrSize">

<div class="users" style='width:70%;margin:0 auto'>

				<h2>Message List</h2>

				<p style="text-align:right;margin-right:10px">
								<?php echo $this->Html->link("New Message", array('action' => 'newMessage')); ?>
				</p>
				<ul style="list-style-type:none" id="messageLists">
					<?php foreach ($messages_list as $message): ?>

						<li style="height:auto;width:70%;border:1px solid black;margin-top:1%;margin-bottom:1%;display:inline-block;margin-left:0px;margin-right:0px" 
						 data-id="<?php echo $message['Message']['id'] ?>" >


										<?php if($message['Message']['from_id'] == AuthComponent::user('id')): ?>

												<img class="img_btn" data-id="<?php echo $message['UserJoin']['rid'] ?>" 
													src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['UserJoin']['rimage'] ?>"  
													style="width:100px;height: 100px;float:left;"
												/> 

												
										<?php else: ?>

												<img class="img_btn" data-id="<?php echo $message['SenderJoin']['sid'] ?>" 
													src="<?php echo $this->webroot; ?>/img/profile/<?php echo $message['SenderJoin']['simage'] ?>"  
													style="width:100px;height: 100px;float:left;"
												/> 

										<?php  endif; ?>



										<p 
											style="margin:3%;display:inline-block;width:inherit;	
												white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"
											class="message_div" 
											receiver-id="<?php echo $message['UserJoin']['rid'] ?>"
											sender-id="<?php echo $message['SenderJoin']['sid'] ?>"	
										>
											<?php echo $message['Message']['content']; ?>
										</p>

										<hr>

										<span style="text-align:right;margin-right:10px;float:right;margin-top:1.5%;">
											<?php 
												echo date("Y/m/d H:i a", strtotime($message['Message']['created'])); 
											?>
										</span>

										<button class="btn_user_sender"
											 data-id="<?php echo $message['Message']['id'] ?>" 
											 receiver-id="<?php echo $message['UserJoin']['rid'] ?>" 
											 sender-id="<?php echo $message['SenderJoin']['sid'] ?>"
											 style="display:inline-block;margin-left:2%;margin-top:1.5%;margin-bottom: 1%;"
										>
													Delete Conversation 
										</button>
										
						</li>

						<li style="clear:both;"></li>
						

					<?php endforeach; ?>

				</ul>

				
			    <?php if ($arraySize > 4): ?>
			
					<div style="margin:0 auto;width:70%;display:block;">
									
							<a href="#" id="btn-showMore" style="display:block;">Show more</a>
					</div>


				<?php endif; ?>

				<img src="<?php echo $this->webroot; ?>/img/empty.png"   style="display:none;" id="emptyImage"/> 



				<div style="margin:0 auto;width:70%;display:none;">
								
					<p id="showError" style="color:red;">NO MORE CONVERSATION TO LOAD !</p>

				</div>

				<input type="hidden" id="startSql" value="4">

				<input type="hidden" id="authId" value="<?php echo $userId; ?>">



				<div id='errorShowMessage' style="color:red;font-size:18px;margin:0 auto;width:70%;display:block;"></div>
				

</div>



<!-- 
<?php echo $this->element('sql_dump') ?> -->


<script type="text/javascript">


	 $('.container').infiniteScroll({
   		  navSelector  : '.next',    // selector for the paged navigation 
	      nextSelector : '.next a',  // selector for the NEXT link (to page 2)
	      itemSelector : '.message-item',     // selector for all items you'll retrieve
	      debug         : true,
	      responseType:'text',
	});



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



			//$("#messageLists").on('click','.message_div',function() {

			$("#messageLists").on('click','.message_div',function() {

				 var receiver_id = $(this).attr('receiver-id');

				 var sender_id = $(this).attr('sender-id');

				 document.location.href = "/MessageBoard/messages/messageDetails/" + receiver_id + "/" + sender_id;

			
			});



			$("#messageLists").on('click','.btn_user_sender',function() {

				var messageId = $(this).attr('data-id');

				var receiver_id = $(this).attr('receiver-id');

				 var sender_id = $(this).attr('sender-id');

				//var searchDiv = $("div").find("[data-messageDiv='" + messageId + "']"); 


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

			        	//console.log(arraySize);

			        	searchDiv.fadeOut();

			        }  
				});

				
				//searchDiv.fadeOut();

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

									 '<li style="height:auto;width:70%;border:1px solid black;margin-top:1%;margin-bottom:1%;display:inline-block;margin-left:0px;margin-right:0px;">' + 
										
										'<img class="img_btn" data-id="' + response[i].UserJoin.rid + '"' + 
										' src="/MessageBoard/img/profile/' + response[i].UserJoin.rimage + '" style="width:100px;height:100px;float:left;">' +

										'<p style="margin:3%;display:inline-block;width:inherit;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" class="message_div"' + ' receiver-id="' + response[i].UserJoin.rid + '"' + ' sender-id="' + response[i].SenderJoin.sid + '">' + response[i].Message.content + '</p>' + 

										'<hr>' + '<span style="text-align:right;margin-right:10px;float:right;margin-top:1.5%;">' + 

										response[i].Message.created + '</span>' + 

										'<button class="btn_user_sender" ' + 
										' data-id="' + response[i].Message.id + '"' +  ' receiver-id="' + response[i].UserJoin.rid + '"' +
										' sender-id="' + response[i].SenderJoin.sid + '"' + 'style="display:inline-block;margin-left:2%;margin-top:1.5%;margin-bottom:1%;">' +
										'Delete Conversation' + '</button>'


										+ '</li>';			
						
								  }
								  //end if

								  $("#messageLists").append(str);

								  //end foreah
							  }

						  }
					});	

			});


	});


</script>


