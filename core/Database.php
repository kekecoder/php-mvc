<?php

namespace app\core;

use Exception;
use PDO;

class Database{
    public PDO $pdo;

    public function __construct(array $config){
        try{
            $dsn = $config['dsn'] ?? '';
            $user = $config['user'] ?? '';
            $password = $config['password'] ?? '';
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            print 'Error ' . $e->getMessage();
            print 'Server down, try again later';
        }
    }

}