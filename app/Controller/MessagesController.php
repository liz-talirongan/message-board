<?php 
	

	class MessagesController extends AppController{
		
					public $helpers = array('Html','Form','Js'=>array("Jquery"),'Paginator');

					public  $uses = array('Message','User');

					public $components = array('RequestHandler', 'Paginator');




					public function index(){	

									$this->set('messages_list',self::getConversation('list',0,4));

									$this->set('messages_list_all',self::getConversation('count',0,0));

									$this->set('userId',$this->Auth->user('id'));

					}



					private function getConversation($type,$start,$limit)
					{
						

							$conditions = array();

							$result;

							$findType = 'all';

							switch ($type) {
								case 'count':

									$findType = 'count';
									
									$conditions['joins'] =  array(
											array(
												'table' => 'messages',
												'alias' => 'Message1',
												'type' => 'INNER',
												'conditions' => array(
													'LEAST(Message.to_id,Message.from_id) = LEAST(Message1.to_id,Message1.from_id)',
													'GREATEST(Message.to_id,Message.from_id) = GREATEST(Message1.to_id,Message1.from_id)'
												)
											)
									);

									$conditions['conditions'] = array(
											'OR' => array(
												array('Message.to_id' => $this->Auth->user('id')),
												array('Message.from_id' => $this->Auth->user('id'))
											)
									);

									$conditions['group'] = array('LEAST(Message.to_id,Message.from_id)','GREATEST(Message.to_id,Message.from_id)');

									$result = $this->Message->find($findType,$conditions);

									break;

								case 'list':

									$userId = $this->Auth->user('id');

									$query1 = "SELECT 
													UserJoin.name AS rname, UserJoin.id AS rid, 
													SenderJoin.name AS sname,SenderJoin.id AS sid,
													SenderJoin.image AS simage, UserJoin.image AS rimage, 
													Message.to_id, Message.from_id, Message.content, 
													Message.created, Message.id, 
													LEAST(Message.to_id,Message.from_id) as id1, 
													GREATEST(Message.to_id,Message.from_id) as id2, 
													MAX(Message.id) AS max_id 
											FROM  messages AS Message 
											LEFT JOIN users AS UserJoin ON (UserJoin.id = Message.to_id) 
											LEFT JOIN users AS SenderJoin ON (SenderJoin.id = Message.from_id) 
											INNER JOIN(
												SELECT 
													MAX(id) as max_id,LEAST(to_id,from_id) as id3,GREATEST(to_id,from_id) AS id4 
													from messages 
													GROUP BY id3,id4 
													ORDER BY max_id
											) AS Message1
												ON(Message.id = Message1.max_id)
											WHERE ((Message.to_id = {$userId}) OR (Message.from_id = {$userId})) 
											GROUP BY id1, id2 
											ORDER BY Message.id  DESC
											LIMIT {$start},{$limit}";

									$result = $this->Message->query($query1);


									break;
							}





							return $result;
						
					}


					public function loadMoreConversation(){

									$this->autoRender = false;

						
									if($this->request->is('ajax')){


													$start = $this->request->data['start'];
													$limit = $this->request->data['limit'];


									 				$message_list = self::getConversation('list',$start,$limit);

									 				if (sizeof($message_list) != 0) {
														$this->set('message_list',$message_list);
														$this->render('/Elements/conversation');
													}

													return json_encode("no_more");
									}




					}

					private function getReceiverId($userId,$userId1){

						$result = $userId1;

						return $this->Auth->user('id') != $userId ? $userId : $userId1;
					}

					private function getMessageDetails($receiverId,$senderId,$type,$start,$limit){

						$findType = 'all';
						$conditions = array(
												'joins' => array(
													array(
														'table' => 'users',
														'alias' => 'UserJoin',
														'type' => 'LEFT',
														'conditions' => array(
															'UserJoin.id = Message.to_id',
														)
													),
													array(
														'table' => 'users',
														'alias' => 'SenderJoin',
														'type' => 'LEFT',
														'conditions' => array(
															'SenderJoin.id = Message.from_id'
														)
													)
												),
												'conditions' => array(
													'OR' => array(					
																array(
																	'Message.to_id' => $receiverId,
																	'Message.from_id' => $senderId
																),
																array(
																	'Message.to_id' => $senderId,
																	'Message.from_id' => $receiverId
																)
													)
												),			
												'order' => array('Message.created' => 'DESC','Message.id' => 'DESC'),
												'fields' => array('UserJoin.name as rname','UserJoin.id as rid','SenderJoin.name as sname','SenderJoin.id as sid','SenderJoin.image as simage','UserJoin.image as rimage','Message.id','Message.from_id','Message.to_id','Message.content','Message.created')
										
						);

						if ($type == 'list') {
							$conditions['offset'] = $start;

							$conditions['limit'] = $limit;
 						}else{

 							$findType = 'count';
 						}


						return $this->Message->find($findType,$conditions);


					}

					public function messageDetails($receiverId,$senderId)
					{

									$this->set('meid',self::getReceiverId($receiverId,$senderId));


									$this->set('messages_list_all',self::getMessageDetails($receiverId,$senderId,'count',0,0));


					}



					public function deleteSingleMessage(){
									$this->autoRender = false;

									if ($this->request->is('post')){
										//echo "here on request post";

										$messageId = $this->request->data['messageId'];

									
										$this->Message->delete($messageId);

									}

									echo "here on the delete single message ";
					}

					public function replyMessage(){

									$this->autoRender = false;

									if($this->request->is('post')){
										
													$this->Message->create();

													$this->request->data['Message']['content'] = $this->request->data['replyMessage'];

													$this->request->data['Message']['to_id'] = $this->request->data['receiverId'];

													$this->request->data['Message']['from_id'] =  $this->Auth->user('id');

													$this->Message->save($this->request->data);
										
									}			 

					}


					public function newMessage(){
						if($this->request->is('post')){
							
										$this->Message->create();

										$this->request->data['Message']['to_id'] = $this->request->data['Message']['recipient'];
										$this->request->data['Message']['from_id'] = $this->Auth->user('id');

										if($this->Message->save($this->request->data)){
											$this->redirect(array('action' => 'index')); 
										}
						}
					}


					public function deleteConversation(){


									$this->autoRender = false;

									if ($this->request->is('post')){

													$receiver =  $this->request->data['receiverId'];

													$sender =  $this->request->data['senderId'];

													$condition = $this->Message->deleteAll(array(
														'AND' => array(
																	'Message.to_id' => array($receiver,$sender),
																	'Message.from_id' => array($receiver,$sender)
														)
													));

													if($condition){
														echo "ok";
													}
									}


					}


					public function loadMoreMessageDetails(){

									$this->autoRender = false;

							
									if($this->request->is('ajax')){

													$receiverId = $this->request->data['receiverId'];

													$authId = $this->Auth->user('id');

													$start = $this->request->data['start'];

													$limit = $this->request->data['limit'];

													$my_list = self::getMessageDetails($receiverId,$authId,'list',$start,$limit);

													if (sizeof($my_list) != 0) {
														$this->set('message_list',$my_list);
														$this->render('/Elements/details');

													}

													return  json_encode("no_more");
									}
					}



					public function search(){
									$this->autoRender = false;

									$term = $this->request->query['q'];


									if(!isset($term)){
										$users = $this->User->find('all',array(
											'limit' => 5
										));
									}else{
										$users = $this->User->find('all',array(
											'conditions' => array(
												'User.name LIKE' => '%'.$term.'%'
											)
										));
									}
						
							
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