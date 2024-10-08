<?php

namespace app\controllers;

use app\db\Connection;

class BaseController
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    protected function render($fileName, $params = [])
    {
        extract($params);
        ob_start();
        require_once $fileName;
        return ob_get_clean();
    }
}