<?php

namespace John;

abstract class Record
{
    protected static $_db;
    protected $_data = [];
    protected $_tableName = 'table';

    public function __construct($dsn, $username, $password)
    {
        static::$_db = new \PDO($dsn,$username,$password);
    }
   
    public function __set($name,$value)
    {
        if (array_key_exists($name,$this->_data))
	{
	    $this->_data[$name] = $value;
	}
    }

    public function quoteIdentifier($column)
    {
        return "`" . $column . "`";
    }


    public function save()
    {
	return ($this->_data['id']) ? $this->_doUpdate() : $this->_doInsert();
    }

    protected function _doInsert()
    {
	$bind = $this->_data;
        $cols = [];
        $vals = [];
        if(empty($this->_data['id']))
        {
            foreach ($bind as $key => $val)
	    {
    	        $cols[] = $this->quoteIdentifier($key);
                $vals[] = '?';
            }
        }
	$sql = "INSERT INTO ";
	$sql .= $this->quoteIdentifier($this->_tableName);
	$sql .=' ('. implode(',',$cols) . ')';
	$sql .=' VALUES ('. implode(',',$vals) . ')';
	$stmt = static::$_db->prepare("$sql");
	$stmt->execute(array_values($bind));
	return static::$_db->lastInsertId();
    }
    protected function _doUpdate()
    {
	return 'KennyXie';
    }
	
    public function truncate()
    {
	static::$_db->exec('TRUNCATE TABLE '. $this->quoteIdentifier($this->_tableName));
    }
}
