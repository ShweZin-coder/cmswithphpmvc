<?php

class Router extends Entity{

    public $id;
    public $module;
    public $action;
    public $entity_id;
    public $pretty_url;
    public function __construct($dbc)
    {
        $this->dbc = $dbc;
        $this->tableName = "routes";
        $this->fields = [
            'id',
            'module',
            'action',
            'entity_id',
            'pretty_url'
        ];
    }

  
}