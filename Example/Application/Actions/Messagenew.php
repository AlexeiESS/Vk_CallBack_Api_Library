<?php
namespace Actions;

use Core\Query;


class Messagenew extends Query {

	protected $token = '';
	protected $data = [];
	protected $user_name = '';
	protected $user_id = '';
	protected $mess = '';

	function __construct($token,$data){
		$this->user_id = $data->object->message->from_id;
		$this->data = $data;
		$this->mess = mb_strtolower(trim($data->object->message->text));
		$this->token = $token;
		$this->get_info_user($this->user_id);
		echo('ok');
	}
	public function message_new(){
		$request_params = $this->message_text($this->mess);
		if($this->query_to_api('true', $request_params)==1)
		{
			return 1;
		}
		else {
			return 0;
		}
	}
	public function message_text($text){
		$message = $this->message_text_match($text);
		return $message;
	}
	public function message_text_match($text){
		switch ($text) {
			case 'example':
				require_once 'Data/Message/example.php'; 
				return message($this->token,$this->user_id,$this->user_name);
			break;
		}
	}
	public function get_info_user($user_id){
		$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$this->token}&v=5.131"));
		$this->user_name = $user_info->response[0]->first_name;
		return 1;
	}
}
?>
