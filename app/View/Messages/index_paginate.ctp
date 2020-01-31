<?php 

			echo $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js',array(
				'integrity'=>'sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=',
				'crossorigin'=> 'anonymous'
			));

			// echo $this->Html->script('https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js');


?>



		<div class="users index">

						<h2>Message List</h2>

						<div id="message-list">

							<?php foreach($allmessages as $message): ?>
						        <div class="message-item">
						            <p><?php echo $message['Message']['content']; ?></p>
						            <p><?php echo $message['Message']['id']; ?></p>
						            <hr/>
						        </div>
					        <?php endforeach; ?>

						</div>


						 <?php 

						 	echo $this->Paginator->next('Show more message...');

						 ?>


		</div>
			




		<div class="actions">

						<h3>Menu</h3>
						<ul>
							<li><?php echo $this->Html->link('New Message',array('action' => 'newMessage')) ?> </li> 
						</ul>

		</div>



<script type="text/javascript">
			
	$(document).ready(function () {

		$('.container').infiniteScroll({
			 checkLastPage:true
			 itemSelector : '.message-item',     // selector for all items you'll retrieve
			 debug         : true,
			 dataType	 	: 'html',
		});


	});



</script>