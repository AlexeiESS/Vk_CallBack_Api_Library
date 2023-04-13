<?php

function message($token, $user_id, $user_name=''){
	return [
					'message' => "Привет подписчик нашего паблика МыНеКурим! Теперь у нас есть свой бот, простенький, но всё же полезный!",
					'peer_id' => $user_id,
					'access_token' => $token,
					'v' => '5.131',
					'random_id' => '0',
                    'keyboard' => '{
   "one_time":false,
   "buttons":[
 
      [
         {
            "action":{
               "type":"text",
               "payload":"{\"button\": \"2\"}",
               "label":"Погода"
            },
            "color":"positive"
         },
         {
            "action":{
               "type":"text",
               "payload":"{\"button\": \"2\"}",
               "label":"О боте"
            },
            "color":"primary"
         },
         {
            "action":{
               "type":"text",
               "payload":"{\"button\": \"2\"}",
               "label":"Саня Нопин"
            },
            "color":"secondary"
         }
      ]
   ]
}'
				];
}


?>