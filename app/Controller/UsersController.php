<?php 
	
	class UsersController extends AppController{

		public $helpers = array('Html','Form');

		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('register','success');
			$this->Auth->autoRedirect = false;
		}


		public function index(){
			
		}	

		public function success(){

		}


		public function register(){
			if($this->request->is('post')){
				$this->request->data['User']['created_ip'] = $this->request->clientIp();
				if($this->User->save($this->request->data)){
					$this->redirect(array('controller'=>'users','action'=>'success'));
				}
			}
		}

		public function login(){
			if ($this->request->is('post')){
				if($this->Auth->login()){
					 $this->User->id = $this->Auth->user('id');
					 $this->User->saveField('last_login_time',date("Y-m-d H:i:s"));
					 $this->User->saveField('modified_ip',$this->request->clientIp());
					 $this->User->saveField('modified',date("Y-m-d H:i:s"));
					$this->redirect(array('controller'=>'messages','action'=>'index'));
				}else{
					$this->Session->setFlash('Your username/password was incorrect');
				}
			}
		}



		public  function updateLoginFields(){
			$this->User->id = $this->Auth->user('id');
			$this->User->read();
			$this->User->data['last_login_time'] = date("Y-m-d H:i:s");
			$this->User->data['User']['modified_ip'] = $this->request->clientIp();
			 $this->User->save($this->User->data, false);
		}

		public function logout(){
			$this->redirect($this->Auth->logout());
		}	

	}
?>