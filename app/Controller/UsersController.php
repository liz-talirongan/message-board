<?php 
	
	class UsersController extends AppController{

					public $helpers = array('Html','Form','Time');

					public function beforeFilter(){
									parent::beforeFilter();
									$this->Auth->allow('register','success');
									$this->Auth->autoRedirect = false;
					}


					public function index(){
						
									$userProfile = $this->User->findById($this->Auth->user('id'));

									$gender = "";

									if ($userProfile['User']['gender'] == 1){
										$gender = "Male";
									}else if($userProfile['User']['gender'] == 2){
										$gender = "Female";
									}else{
										$gender = '';
									}

									$dateOfBirth = $userProfile['User']['birthdate'];
									$today = date("Y-m-d");
									$diff = date_diff(date_create($dateOfBirth), date_create($today));
								
									$age = $diff->format('%y');


									$this->set('user',$userProfile);

									$this->set('gender',$gender);

									$this->set('profileId',$this->Auth->user('id'));

									$this->set('age',$age);

					}	

					public function success(){

					}


					public function profile($id){

									if(isset($id)){
													$userProfile = $this->User->findById($id);

													$gender = "";

													if ($userProfile['User']['gender'] == 1){
														$gender = "Male";
													}else if($userProfile['User']['gender'] == 2){
														$gender = "Female";
													}else{
														$gender = '';
													}

													$dateOfBirth = $userProfile['User']['birthdate'];
													$today = date("Y-m-d");
													$diff = date_diff(date_create($dateOfBirth), date_create($today));
												
													$age = $diff->format('%y');


													$this->set('user',$userProfile);

													$this->set('gender',$gender);

													$this->set('profileId',$id);

													$this->set('age',$age);

									}

					}


					public function editProfile(){
						

									$user_profile = $this->User->findById($this->Auth->user('id'));

									$frmData = $this->request->data;

									$this->set('userImage',$user_profile['User']['image']);

									$this->set('ann',$user_profile);

									if(!$this->request->data){
													$this->request->data = $user_profile;
									}


									if ($this->request->is(array('post','put'))){

													$this->User->id = $this->Auth->user('id');

													if($this->request->data['User']['imageFile']){
																	$tmp = $frmData['User']['imageFile']['tmp_name'];
																	$hash = rand();

																	$date = date('Ymd');

																	$image = $date.$hash."-".$frmData['User']['imageFile']['name'];

																	$target = WWW_ROOT.'img'.DS.'profile'.DS;

																	$target = $target.basename($image);

																	if (move_uploaded_file($tmp, $target)){	
																		
																		$this->request->data['User']['image'] = $image;
																	}
													}
										

													$this->request->data['User']['modified'] = date("Y-m-d H:i:s");
							
													if ($this->User->save($this->request->data)){
													
														$this->redirect(array('action' => 'profile',$this->Auth->user('id')));
													}
									}

					}

					public function changePassword(){

									if($this->request->is('post')){
													$userInfo = $this->User->findById($this->Auth->user('id'));

													if(AuthComponent::password($this->data['User']['old_password']) == $userInfo['User']['password']){

																$this->User->id = $this->Auth->user('id');
														
																$this->User->saveField('modified',date("Y-m-d H:i:s"));

																if($this->User->save($this->data)){
																	$this->Session->setFlash('Password Changed Successfully', 'default', array('class' => 'green'));
											                        $this->redirect(array('action' => 'profile',$this->Auth->user('id')));
																}

													}else{
																$this->Session->setFlash('Incorrect Current Password', 'default', array('class' => 'red'));
													}
									}
					}


					public function register(){
									if($this->request->is('post')){
													$this->request->data['User']['created_ip'] = $this->request->clientIp();
													$this->request->data['User']['image'] = "default.jpg";
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



					public function logout(){
								$this->redirect($this->Auth->logout());
					}	

	}
?>