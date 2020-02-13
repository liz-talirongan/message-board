<?php 

      echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

 
?>


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


					</ul>

					<?php if ($messages_list_all > 4): ?>
							<div style="margin:0 auto;width:70%;display:block;">
										
										<a href="#" id="btn-showMore" style="display:block;">Show more</a>
							</div>
					<?php endif; ?>

					

	</div>

	<div id='errorShowMessage' style="color:red;font-size:18px;margin:0 auto;width:70%;display:block;"></div>

	


</div>






<script type='text/javascript'>


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



	
</script>