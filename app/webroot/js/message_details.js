	$(document).ready(function () {


					var start = 0;

					var limit = 4;

					loadMoreMessageDetails();


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

					 		start = start + limit;

					 		limit = 10;

					 		loadMoreMessageDetails();


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
									        }  
									});
					});



					$("#userLists").on('click','.img_btn',function() {

									var user_id = $(this).attr('data-id');

									document.location.href = "/MessageBoard/users/profile/" + user_id;

					});



					$("#userLists").on('click','.more',function(e) {


									var message_id = $(this).attr('data-id');

									var searchParagraph = $("div").find("[fade-id='" + message_id + "']"); 

									var linkText = $(this).text();

											
									if (linkText == 'Read More') {	

										readMore(searchParagraph.children('p'));

											
									}else{
										readLess(searchParagraph.children('p'));
									}


									$(this).text(readMoreLinkText(linkText));


					});


					function loadMoreMessageDetails()
					{

									var receiverId = $('#receiver_id').val();

							
									$.ajax({
												url:'/MessageBoard/messages/loadMoreMessageDetails',
												type:'POST',
												data: {
													"start":start,
													"limit":limit,
													"receiverId":receiverId
												},
												success:function(response)  
												{  
																
																if(response == "\"no_more\""){
																	$('div #btn-showMore').css({
																		'display':'none'
																	});

																	$(errorShowMessage).append('<p style="display:block">No more message to load! </p>');
																}else{

																	$('#userLists').append(response);
																}


												}
																		
									});

					}



	});