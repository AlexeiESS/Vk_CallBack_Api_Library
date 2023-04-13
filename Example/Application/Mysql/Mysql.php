<?php

namespace Mysql;

class Mysql 
{
	var $link = 0;
	var $result = '';
	function __construct($db_host, $db_user, $db_pass, $db_name)
	{
		$this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
		mysqli_set_charset ($this->link,'utf8');
	}

	public function query($query)
    {
        $this->result = '';
        if ($query) 
        {
                $this->result = @mysqli_query($this->link,$query);
        }
        if ($this->result) 
        {
            return $this->result;
        } 
        else 
        {
            return 'Error sql query - '.$query; 
        }
    }
 	public function numrows($query = 0)
    {
            return @mysqli_num_rows($query);
    }
	public function fetchrow($query = 0)
    {
			$this->result = @mysqli_fetch_array($query);
			return $this->result;
    }
    public function fetchrowAll($query = 0){
        $this->result = @mysqli_fetch_all($query);
        return $this->result;
    }
	public function escape($query)
    {
       return mysqli_real_escape_string($this->link, $query);
    }
}

?>