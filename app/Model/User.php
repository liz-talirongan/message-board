<?php 

	class User extends AppModel{

		public $name = 'User';

		public $validate = array(

			'name' => array(
				'The username must be between 5 and 20 characters'=> array(
					'rule' => array('between',5,20),
					'message' => 'Between 5 to 20 characters'
				)
			 ),
			 'email' => array(
			 	'Valid email' => array(
 					'rule' => array('email'),
 					'message' => 'Please enter a valid email address'
			 	),
			 	'The email has already been registered' => array(
			 		'rule' => 'isUnique',
			 		'message' => 'The email has already been registered'
			 	)
			 ),
			 'password' => array(
			 	'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please enter your password confirmation'
			 	)
			 ),
			 'password_confirmation' => array(
			 	'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please enter your password confirmation'
				 ),
				'Match passwords'=>array(
					'rule'=>'matchPasswords',
					'message'=>'Your password do not match'
			   	)
			 ),
			 'gender' => array(
			 	'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please select a gender!'
			 	)
			 ),
			 'hubby' => array(
			 	'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please input your hubbies!'
			 	)
			 ),
			 'birthdate' => array(
			 	'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please select your birthdate!'
			 	)
			 ),
			 'image' => array(
			 	'Not empty'=>array(
			 		 'rule'=>'notBlank',
			 		 'message'=>'Please select your birthdate!'
			 	)
			 ),
			 'old_password' => array(
				'Not empty'=>array(
					 'rule'=>'notBlank',
					 'message'=>'Please input your current password'
				)
			),


		);

		public function matchPasswords($data){
			if($this->data['User']['password'] == $this->data['User']['password_confirmation']){
				return true;
			}

			return false;
		}

		public function beforeSave($options = array()){
			if(isset($this->data['User']['password'])){
				$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
				$this->data['User']['created'] = date("Y-m-d H:i:s");
			}

			return true;
		}
	}


?>