

				$(document).ready(function () {


								var start = 0;

								var arraySize = parseInt($('#arrSize').val());

								var limit = 4;

								loadMoreConversation();

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

										start = start + limit;

										limit = 10;

										loadMoreConversation();


								});


								function loadMoreConversation()
								{


									  var authId = $('#authId').val();


										$.ajax({
											url:'/MessageBoard/messages/loadMoreConversation',
					                          type:'POST',
					                          data: {
					                            "start":start,
					                            "limit":limit
					                          },
											  success:function(response){
												
												  var responseLength = response.length;
												  
												  if (response == "\"no_more\""){

														$('div #btn-showMore').css({
															'display':'none'
														});

														$(errorShowMessage).append('<p style="display:block">No more message conversation to load! </p>');

												  }else{
												  	$('#messageLists').append(response);
												  }

				

											  }
										});	

								}


				});