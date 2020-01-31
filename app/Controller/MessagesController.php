<?php 
	

	class MessagesController extends AppController{
		
		public $helpers = array('Html','Form','Js'=>array("Jquery"),'Paginator');

		public  $uses = array('Message','User');

		public $components = array('RequestHandler', 'Paginator');




		public function index(){	



			

			$message_list = $this->Message->find('all', array(
				'fields' => array(
					'UserJoin.name as rname',
					'UserJoin.id as rid',
					'SenderJoin.name as sname',
					'SenderJoin.id as sid',
					'SenderJoin.image as simage',
					'UserJoin.image as rimage', 
					'Message.to_id',
					'Message.from_id',
					'Message.content',
					'Message.created',
					'Message.id',
					"LEAST(Message.to_id,Message.from_id) as id1",
					"GREATEST(Message.to_id,Message.from_id) as id2",
					"MAX(Message.id) AS max_id"
				),
				'joins' => array(
					array(
						'table' => 'users',
						'alias' => 'UserJoin',
						'type' => 'LEFT',
						'conditions' => array(
							'UserJoin.id = Message.to_id'
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
						array('Message.to_id' => $this->Auth->user('id')),
						array('Message.from_id' => $this->Auth->user('id'))
					)
				),	
				'group' => array('id1','id2'),
				'order' => array('Message.id' => 'DESC')
			));


				$userId = $this->Auth->user('id');

	$queryStr = "
				SELECT UserJoin.name AS rname, UserJoin.id AS rid, SenderJoin.name AS sname,SenderJoin.id AS sid, SenderJoin.image AS simage, UserJoin.image AS rimage, 
				Message.to_id, Message.from_id, Message.content, Message.created, Message.id, 
				LEAST(Message.to_id,Message.from_id) as id1, 
				GREATEST(Message.to_id,Message.from_id) as id2, 
				MAX(Message.id) AS max_id 
				FROM  messages AS Message 
				INNER JOIN(SELECT id,to_id,from_id,content,MAX(id) as max_id,LEAST(to_id,from_id) as id3,GREATEST(to_id,from_id) AS id4 from messages GROUP BY id3,id4 ORDER BY max_id) AS Message1
				ON(Message.id = Message1.max_id)
				LEFT JOIN users AS UserJoin ON (UserJoin.id = Message.to_id) 
				LEFT JOIN users AS SenderJoin ON (SenderJoin.id = Message.from_id) 
				WHERE ((Message.to_id = {$userId}) OR (Message.from_id = {$userId})) 
				GROUP BY id1, id2 
				ORDER BY Message.id DESC LIMIT 4";



			 $message_list_limit_new = $this->Message->query($queryStr);



			$this->set('messages_list',$message_list_limit_new);

			$this->set('messages_list_all',$message_list);

			$this->set('userId',$this->Auth->user('id'));


		}


		public function loadMoreConversation(){

			$this->autoRender = false;

			
			if($this->request->is('ajax')){


					$start = $this->request->data['start'];

					$userId = $this->Auth->user('id');

					$queryStr = "
							SELECT UserJoin.name AS rname, UserJoin.id AS rid, SenderJoin.name AS sname,SenderJoin.id AS sid, SenderJoin.image AS simage, UserJoin.image AS rimage, 
							Message.to_id, Message.from_id, Message.content, Message.created, Message.id, 
							LEAST(Message.to_id,Message.from_id) as id1, 
							GREATEST(Message.to_id,Message.from_id) as id2, 
							MAX(Message.id) AS max_id 
							FROM  messages AS Message 
							INNER JOIN(SELECT id,to_id,from_id,content,MAX(id) as max_id,LEAST(to_id,from_id) as id3,GREATEST(to_id,from_id) AS id4 from messages GROUP BY id3,id4 ORDER BY max_id) AS Message1
							ON(Message.id = Message1.max_id)
							LEFT JOIN users AS UserJoin ON (UserJoin.id = Message.to_id) 
							LEFT JOIN users AS SenderJoin ON (SenderJoin.id = Message.from_id) 
							WHERE ((Message.to_id = {$userId}) OR (Message.from_id = {$userId})) 
							GROUP BY id1, id2 
							ORDER BY Message.id DESC LIMIT {$start},10";



			 	$message_list_limit_new = $this->Message->query($queryStr);


				echo json_encode($message_list_limit_new);


			}




		}


		public function messageDetails($receiverId,$senderId)
		{

		
			//find the receiver id

			$receiver = 0;


			if($this->Auth->user('id') != $receiverId){
				$receiver = $receiverId;

			}else{
				$receiver = $senderId;
			}

				
			
			$my_list = $this->Message->find('all', array(
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
				//'group' => array('UserJoin.name','SenderJoin.name'),
				'order' => array('Message.created' => 'DESC','Message.id' => 'DESC'),
				'fields' => array('UserJoin.name as rname','UserJoin.id as rid','SenderJoin.name as sname','SenderJoin.id as sid','SenderJoin.image as simage','UserJoin.image as rimage','Message.id','Message.from_id','Message.to_id','Message.content','Message.created'),
				'limit' => 4
				
			));	

			$my_list_all = $this->Message->find('all', array(
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
				//'group' => array('UserJoin.name','SenderJoin.name'),
				'order' => array('Message.created' => 'DESC','Message.id' => 'DESC'),
				'fields' => array('UserJoin.name as rname','UserJoin.id as rid','SenderJoin.name as sname','SenderJoin.id as sid','SenderJoin.image as simage','UserJoin.image as rimage','Message.id','Message.from_id','Message.to_id','Message.content','Message.created')
				
			));	




			$this->set('meid',$receiver);

			$this->set('messages_list',$my_list);

			$this->set('messages_list_all',$my_list_all);


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

			if($this->request->is('post'))
			{
				//echo "save me please";

				//echo $this->request->data['receiverId'];

				$this->Message->create();

				$this->request->data['Message']['content'] = $this->request->data['replyMessage'];

				$this->request->data['Message']['to_id'] = $this->request->data['receiverId'];

				$this->request->data['Message']['from_id'] =  $this->Auth->user('id');

				//$this->Message->save($this->request->data);

				$this->Message->save($this->request->data);
				

			}			 

		}


		public function newMessage(){
			if($this->request->is('post')){
				
				$this->Message->create();

				//$this->Session->setFlash('Incorrect Current Password', 'default', array('class' => 'red'));
				

				$this->request->data['Message']['to_id'] = $this->request->data['Message']['recipient'];
				$this->request->data['Message']['from_id'] = $this->Auth->user('id');

				if($this->Message->save($this->request->data))
				{
					$this->redirect(array('action' => 'index')); 
				}
			}
		}


		public function deleteConversation(){


			//receiver_id,sender if

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

					$my_list = $this->Message->find('all', array(
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
												'Message.from_id' => $authId
											),
											array(
												'Message.to_id' => $authId,
												'Message.from_id' => $receiverId
											)
								)
							),			
							'order' => array('Message.created' => 'DESC','Message.id' => 'DESC'),
							'fields' => array('UserJoin.name as rname','UserJoin.id as rid','SenderJoin.name as sname','SenderJoin.id as sid','SenderJoin.image as simage','UserJoin.image as rimage','Message.id','Message.from_id','Message.to_id','Message.content','Message.created'),
							'offset' => $this->request->data['start'],
							'limit' => 10,
						
					));	


					echo json_encode($my_list);


				}




		}

		public function search1(){

			  $this->autoRender = false;
					$start = $this->request->data['start'];

					$queryStr = "
				SELECT UserJoin.name AS rname, UserJoin.id AS rid, SenderJoin.name AS sname,SenderJoin.id AS sid, SenderJoin.image AS simage, UserJoin.image AS rimage, 
				Message.to_id, Message.from_id, Message.content, Message.created, Message.id, 
				LEAST(Message.to_id,Message.from_id) as id1, 
				GREATEST(Message.to_id,Message.from_id) as id2, 
				MAX(Message.id) AS max_id 
				FROM  messages AS Message 
				INNER JOIN(SELECT id,to_id,from_id,content,MAX(id) as max_id,LEAST(to_id,from_id) as id3,GREATEST(to_id,from_id) AS id4 from messages GROUP BY id3,id4 ORDER BY max_id) AS Message1
				ON(Message.id = Message1.max_id)
				LEFT JOIN users AS UserJoin ON (UserJoin.id = Message.to_id) 
				LEFT JOIN users AS SenderJoin ON (SenderJoin.id = Message.from_id) 
				WHERE ((Message.to_id = {$userId}) OR (Message.from_id = {$userId})) 
				GROUP BY id1, id2 
				ORDER BY Message.id DESC LIMIT 2,10";




			echo json_encode($message);

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