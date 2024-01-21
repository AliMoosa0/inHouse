<?php



class Database
{

    public static $instance = null;
    public $dblink = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    function __construct()
    {
        if (is_null($this->dblink)) {
            $this->connect();
        }
    }

    function connect()
    {
        $this->dblink = mysqli_connect(
            'localhost',
            'username',
            'password',
            'database name'
        ) or die('CAN NOT CONNECT');
    }

    function __destruct()
    {
        if (!is_null($this->dblink)) {
            $this->close($this->dblink);
        }
    }

    function close()
    {
        mysqli_close($this->dblink);
    }

    function querySQL($sql)
    {
        //echo $sql;
        if ($sql != null || $sql != '') {
            mysqli_query($this->dblink, $sql);
        }
    }

    function singleFetch($sql)
    {
        //echo $sql;
        $fet = null;
        if ($sql != null || $sql != '') {
            $res = mysqli_query($this->dblink, $sql);
            $fet = mysqli_fetch_object($res);
        }
        return $fet;
    }

    function multiFetch($sql)
    {

        $result = null;
        $counter = 0;
        if ($sql != null || $sql != '') {
            $res = mysqli_query($this->dblink, $sql);
            while ($fet = mysqli_fetch_object($res)) {
                $result[$counter] = $fet;
                $counter++;
            }
        }
        return $result;
    }

  

    function getRows($sql)
    {
        $rows = 0;
        if ($sql != null || $sql != '') {
            $result = mysqli_query($this->dblink, $sql);
            $rows = mysqli_num_rows($result);
        }
        return $rows;
    }
}