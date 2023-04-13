<?php


class CoreClass {
	protected $token = '';
	protected $confirmation_token = '';
	protected $data = [];

	function __construct($data){
		require_once 'Configs/api_vk.php'; 
		$this->token = $token; 
		$this->data = $data;
		$this->confirmation_token = $confirmation_token;
		if($data->type=='confirmation'){
			echo $this->confirmation_token;
		}else {
			$this->type_match($data->type);
		}
	}
	public function type_match($type){
		$path = 'Actions\\'.str_replace('_', '',ucfirst($type));
			if(class_exists($path)){
				$action = new $path($this->token,$this->data);
				
			}else {
			$fp = fopen('Logs/ErrorPathToAction.txt', 'w+');
		fwrite($fp, $path);
		fclose($fp);
	}
	
	}
	public function LogJson($data){
		$fp = fopen('Logs/Json.txt', 'w+');
		fwrite($fp, $data);
		fclose($fp);
	}
}

?>