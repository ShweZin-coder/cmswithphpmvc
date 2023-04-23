<?php

namespace modules\user\models;
use src\Entity;
class User extends Entity{

    public $id;
    public $username;
    public $password;
    public $password_hash;
    public function __construct($dbc)
    {
        parent::__construct($dbc,'users');
    }
    protected function initFields()
    {
      $this->fields = [
            'id',
            'username',
            'password',
            'password_hash'
        ];
    }

  
}