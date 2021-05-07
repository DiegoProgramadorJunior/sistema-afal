<?php

class Database{
    public static function connect(){
        $database = new mysqli('localhost','root','','sistema_anfa');
        $database->query("SET NAMES 'utf8'");
        return $database;
    }
}
?>