<?php

namespace model;

use PDO;

class DBConnection
{
    public $dns;
    public $user;
    public $password;

    public function __construct($dns, $user, $password)
    {
        $this->dns = $dns;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect()
    {
        return new PDO($this->dns,$this->user,$this->password);
    }
}