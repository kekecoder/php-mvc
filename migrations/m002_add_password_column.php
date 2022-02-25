<?php

use app\core\Application;

class m002_add_password_column{
    public function up(){
       $db = Application::$app->db;
       $sql = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL";

       $db->pdo->exec($sql);
    }

    public function down(){
        $db = Application::$app->db;
        $sql = "ALTER TABLE users DROP COLUMN password VARCHAR(512)";
 
        $db->pdo->exec($sql);
    }
}