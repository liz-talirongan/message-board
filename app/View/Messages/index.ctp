<?php 

			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

			//echo $this->Html->script('https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js');

			echo $this->Html->script('conversation');


?>




<input type="hidden" value="<?php echo $messages_list_all ?>" id="arrSize">

<div class="users messageDivParent">

				<h2>Message List</h2>

				<p class="newMessageLinkBtn">
								<?php echo $this->Html->link("New Message", array('action' => 'newMessage')); ?>
				</p>
				<ul  id="messageLists">


				</ul>

				
			    <?php if ($messages_list_all > 4): ?>
			
					<div class="divShowMoreBtn">				
							<a href="#" id="btn-showMore">Show more</a>
					</div>


				<?php endif; ?>

				<img src="<?php echo $this->webroot; ?>/img/empty.png"   style="display:none;" id="emptyImage"/> 



				<div class="divNoMoreMessageLoad">
								
					<p id="showError" style="color:red;">NO MORE CONVERSATION TO LOAD !</p>

				</div>

				

				<input type="hidden" id="authId" value="<?php echo $userId; ?>">



				<div id='errorShowMessage' class="erroShowMessageDiv"></div>
				

</div>



