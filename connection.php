<?php


class Connection {
        protected $dbc = NULL;
    
    public function getConnection() {

        if ($this->dbc == NULL)
            $this->dbc = mysqli_connect('localhost', 'root', '', '2nd hand book shop');

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            die('b0ther');
        }

        return $this->dbc;
    }

    public function closeDB()
    {
         mysqli_close($this->dbc);  
    }
}