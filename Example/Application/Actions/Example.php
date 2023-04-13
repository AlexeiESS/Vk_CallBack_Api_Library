<?php
namespace Actions;

use Core\Query;


class Example extends Query {

	protected $token = '';
	protected $data = [];

	function __construct($token,$data){
		$this->data = $data;
		$this->token = $token;
		$this->query_to_api();
	}

}
?>