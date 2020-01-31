<?php 
	
	App::uses('User', 'Model');

	class Message extends AppModel{


		public $validate = array(

			'recipient' => array(
				'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please select a recipient!'
			 	)
			 ),
			 'content' => array(
			 	'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please fill in  a content upon sending !'
			 	)
			 ),
			



		);



	}





?>