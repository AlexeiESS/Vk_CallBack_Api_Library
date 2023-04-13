<?php

namespace Core;


abstract class Query {
	public function query_to_api($send ='false', $data=''){
		if($send=='true'){
		$get_params = http_build_query($data);
		file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
	}
		echo('ok');
		return 1;
	}
}
?>