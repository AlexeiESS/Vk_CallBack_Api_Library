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

	}
	protected function mysql_connect(){
		require_once 'Configs/mysql_cfg.php';
		$this->conn = new Mysql($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
		return 1;
	}
}
?>