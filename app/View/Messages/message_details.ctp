<?php 

      echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

      echo $this->Html->script('show_more');

      echo $this->Html->script('message_details');
 
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



