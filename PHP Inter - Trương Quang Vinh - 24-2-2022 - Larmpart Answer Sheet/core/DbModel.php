<?php

namespace App\core;
abstract class DbModel extends Model{
    
    abstract public function tableName():string;
    abstract public function attributes():array; 
    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }
}