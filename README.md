<h1>Начало Работы</h1>
<p>Для начала загрузите все файлы из папки Application в папку, где будет находится ваш Api, затем перейдите в Configs и впишите значения настроек.</p>
<h1>Отправка запроса подтверждения</h1>
<p>После завершения всех настроек, нужно подтвердить наш Api, ссылка должны выглядеть следующим образом: https://example.com/api/Api.php</p><br>
<p>Т.е. мы обращаемся к файлу Api.php, все запросы должны отправляться строго на него, в противном случае ничего работать не будет</p>
<h1>Создания обработчика событий</h1>
<p>Все обработчики событий хранятся в каталоге Actions, чтобы добавить обработчик, нам нужно создать файл и класс, но они должны называться строго так же, как и тип события, которое нам нужно обработать и без '_', например: <br>Событие 'like_add' = Likeadd <br> на выходе мы должны получить файл и класс с названием Likeadd<br><h2>ВНИМАНИЕ!</h2>Наш класс обязательно должен наследовать абстрактный класс Query, так как в нём происходит вывод статуса 200 (ok) и отправка некоторых данных. <br>Наш класс должен выглядеть вот так:</p>

```php
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

```

<p>А дальше, вы пишите свой обработчик, все функции должны вызываться в конструкторе, а конструктор должен заканчиваться функцией query_to_api()</p>

<h1>Подключение БД в обработчик события</h1>
<p>Подключение БД идёт через класс Mysql, чтобы вам его подключить достаточно воспользоваться этим классом и написать следующую функцию внутри класса, которую в последующем мы вызовем в конструкторе:</p>

```php
<?php
protected function mysql_connect(){
	require_once 'Configs/mysql_cfg.php';
	$this->conn = new Mysql($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
	return 1;
}
```

<p>В конечном итоге мы должны получить следующий класс:</p>

```php
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
   		$this->query_to_api();
	}
	protected function mysql_connect(){
		require_once 'Configs/mysql_cfg.php';
		$this->conn = new Mysql($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
		return 1;
	}
}


```

<p>Пример использования бд:</p>

```php
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
    
    		//Подключаемся к БД
		$this->mysql_connect();
    
    		//Тут выполняется запрос к БД
   		 $this->example();
    
   		 //Отправляем запрос на Api Вконтакте и выводим статус 200 (ok)
  		  $this->query_to_api();
	}
	protected function mysql_connect(){
		require_once 'Configs/mysql_cfg.php';
		$this->conn = new Mysql($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);
		return 1;
	}
  	protected function example(){
    		$this->conn->query("UPDATE users SET password = '123' WEHRE id = 1;");
		return 1;
  	}
}
```

<h1>Особенности</h1>
<h2>Что если массивы для отправки данных слишком длинные?</h2>
<p>Чтобы не писать в одном классе длинные массивы и т.п. создана папка Data, там можно хранить массив, который содержит все параметры сообщения, что должен отправит ваш чат бот</p>
<h2>Функция query_to_api()</h2>
<p>Функция query_to_api() немного своеобразно написана, почему? Потому что когда я работал с Api вконтакте, мне не надо было ничего на него отправлять, а просто выводить статус 200 (ok), но я предусмотрел случай, если надо что-либо отправить, так что для отправки данных, вам нужно задать 2 аргумента функции:<br>1)Заключается в том, чтобы сказать функции, что мы собираемся отправит данные, его значение может быть 'true' или 'false', по умолчанию он равен false <br>2)Массив данных, которые надо отправить на Api вконтакте, по умолчанию $data = ''<br>Пример использования функции с отправкой данных:</p>

```php
<?php
$this->query_to_api('true', $request_params);

```
<h2>ВНИМАНИЕ!</h2>
<p>Обратите внимание на то, что первый аргумент задаётся не как переменная типа Boolean, а как переменная типа String!!</p>
<h1>На последок</h1>
<p>В папке Example - находится пример работоспособствущего api, в него достаточно добавить лишь некоторые значения в настройки конфигов и всё будет работать, так что если что-то объяснено не понятно, загляните туда и попробуйте вникнуть в код, он не сложный)</p>
