<?php

class DBHelper
{
    public $link;
    static private $_instance;
    private $mysql_conf = array(
        'host' => '127.0.0.1:3306',
        'db' => 'moji_db',
        'db_user' => 'root',
        'db_pwd' => 'root'
    );

    // 连接数据库
    private function __construct()
    {
        $this->link = @new mysqli($this->mysql_conf['host'], $this->mysql_conf['db_user'], $this->mysql_conf['db_pwd']);
        if ($this->link->connect_error) {
            die("could not connect to the database:\n" . $this->link->connect_error);
        }
        $this->link->query("set names 'utf8';");
        $this->link->select_db($this->mysql_conf['db']);
        return $this->link;
    }

    private function __clone()
    {
    }

    public static function get_Link()
    {
        if (FALSE == (self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function query($query)
    {
        return $this->link->query($query);
    }

    // 将结果集保存为数组
    public function fetch_array($fetch_array)
    {
        return $this->result = mysql_fetch_array($fetch_array, MYSQL_ASSOC);
    }

    // 获得记录数目
    public function num_rows($query)
    {
        return $this->result = mysql_num_rows($query);
    }

    // 关闭数据库连接
    public function close()
    {
        return $this->result = mysql_close($this->link);
    }
}