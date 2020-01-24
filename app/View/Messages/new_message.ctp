<?php 
			
			echo $this->Html->script('https://code.jquery.com/jquery-2.2.4.min.js',array(
				'integrity'=>'sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=',
				'crossorigin'=> 'anonymous'
			));

			echo $this->Html->css('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css');

		    echo $this->Html->script('https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js');


?>



<div class="users form">
				
				<?php echo $this->Form->create('Message'); ?>	

				<fieldset>
						<legend>New Message</legend>
			
						<?php 
								echo $this->Form->input('recipient',array(
									'type' => 'select',
									'options' => $allusers,
									'hiddenField' => false,
									'id' => 'recipient_list'
								));


								echo $this->Form->input('person_id', array(
								    'type' => 'select',
								    'options' => $allusers,
								    'class' => 'form-control personid',
								    'label' => array(
								        'class' => 'col-md-4 control-label',
								        'text' => 'Osoba'
								    )
								));

			
						?>

						 	
						  <select id="user-select2" style="width:300px"></select>

   						

						<?php 



								echo $this->Form->input('content');
								echo $this->Form->end('Send Message');

						?>

				</fieldset>



</div>


<script type="text/javascript">
		
	$(document).ready(function () {


		  $('#recipient').select2({
			    tag: true,
			    multiple: 'multiple'
		  });

		  $(document).ready(function() {
   			 $('#ohhh').select2();
		  });

		  $('#user-select2').select2({
		    placeholder: "Search for recipient",
		    minimumInputLength: 1,
		    ajax: {
		      url:  '/messages/search',
		      dataType: 'json',
		      data: function (term, page) {
		        return {
		          q: term
		        };
		      },
		      results: function (data, page) {
		        return { results: data };
		      }
		    }
		 });


		 $('.js-data-example-ajax').select2({
			  ajax: {
			    url: 'https://api.github.com/orgs/select2/repos',
			    dataType: 'json'
			    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
			  }
		});



	});

</script>


