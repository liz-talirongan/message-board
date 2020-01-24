<?php 
	

	class MessagesController extends AppController{
		
		public $helpers = array('Html','Form');

		public  $uses = array('User');


		public function index(){
			
		}


		public function newMessage(){
			//find all users probably

			//$this->set('allusers',$this->User->find('all',array('fields' => array('name'))));

			$this->User->recursive = 0;

			$this->set('allusers',$this->paginate());

		}

		public function search(){
			  	$this->autoRender = false;

			    // get the search term from URL
			    $term = $this->request->query['q'];
			    $users = $this->User->find('all');

			    // Format the result for select2
			    $result = array();
			    foreach($users as $key => $user) {
			        $result[$key]['id'] = (int) $user['User']['id'];
			        $result[$key]['text'] = $user['User']['name'];
			    }
			    $users = $result;

			    echo json_encode($users);
		}

	}
?>