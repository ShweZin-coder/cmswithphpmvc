<?php 

namespace modules\page\models;
use src\Entity;

class Page extends Entity{  

    public $id;
    public $title;
    public $content;
    public function __construct($dbc)
    {
        parent::__construct($dbc,'pages');
        
    }
    protected function initFields()
    {
        $this->fields = [
            'title',
            'content'
        ];
    }

}