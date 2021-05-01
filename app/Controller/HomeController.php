<?php namespace App\Controller;

use App\Model\DB;

class HomeController{
    public function index()
    {
        $db = new DB();
        var_dump($db->select());
    }
}