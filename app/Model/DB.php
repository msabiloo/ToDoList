<?php 

namespace App\Model;
use mysql_xdevapi\Exception;

class DB{
    protected $pdo;
    
    public function __construct()
    {
        $config = require __DIR__ .'/../config.php';
        try{
            $this->pdo = new \PDO("mysql:host=127.0.0.1; dbname={$config['db']['database']}", $config['db']['username'], $config['db']['password']);
        } catch (\Exception $e) {
            die('Error :' . $e->getMessage());
        }
    }

    public function select(){
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt-> execute();
        return $stmt-> fetchAll(\PDO::FETCH_OBJ);
    }
}

