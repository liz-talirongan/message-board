<?php 

			echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');

			echo $this->Html->css('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css');

		    echo $this->Html->script('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js');

?>




<div class="users" style="width:60%;margin:0 auto;">
				
				<?php echo $this->Form->create('Message'); ?>	

				<fieldset>
						<legend>New Message</legend>
			

						<?php 	

								echo $this->Form->create('Message');

								echo $this->Form->select('recipient',null,array(
									'id' => 'selUser','style' => 'width:300px',
									
								));

								echo $this->Form->input('content');
								echo $this->Form->end('Send Message');

						?>

				</fieldset>



</div>


<script type="text/javascript">
		
	$(document).ready(function () {


		 $("#selUser").select2({
			placeholder: "Search for recipient",
			ajax: { 
			url: "/MessageBoard/messages/search",
			//type: "post",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					q: params.term // search term
				};
			},
			processResults: function (response) {
				
				
				return {
					results: response
				};
			},
			cache: true
			}
 		});





	});

</script>


