<?php
namespace Actions;

use Core\Query;
use Mysql\Mysql;



class Likeadd extends Query {

	protected $token = '';
	protected $data = [];
	protected $conn = '';

	function __construct($token,$data){
		$this->data = $data;
		$this->token = $token;
		$this->mysql_connect();
		//$this->handler($this->data->object->liker_id);
		$this->query_to_api();
	}
	protected function mysql_connect(){
		require_once 'Configs/mysql_cfg.php';
		$this->conn = new Mysql($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
		return 1;
	}
	function handler($user_id){
		$this->conn->query("UPDATE balls_vk SET summary = summary + 1 WHERE user_id = $user_id");
	}
}
?>