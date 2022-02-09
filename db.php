<?php

    class db{
        private $host="localhost";
        private $dbname="qena2";
        private $user="admin";
        private $password="123";
        private $dbtype="mysql";
        private $connection;

        public function __construct(){
            $this->connection=
                //$connection = new pdo("mysql:host=localhost;dbname=qena2","admin","123");
                new pdo("$this->dbtype:host=$this->host;dbname=$this->dbname",$this->user,$this->password
            );
        }
        function get_connection(){
            return $this->connection;
        }

        function select($cols,$table,$condition=1){
           return $this->connection->query("select $cols from $table where $condition");
        }

        function delete($table,$condition=1){
            return $this->connection->query("delete from $table where $condition");
        }
        function insert($table,$cols){
            return $this->connection->query("insert into $table set $cols");
        }


        function update($table,$cols,$condition){
            return $this->connection->query("update $table set $cols where $condition");
        }
        
    }


?>