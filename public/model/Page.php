<?php 

class Page extends Entity{

    public $id;
    public $title;
    public $content;
    public function __construct($dbc)
    {
        $this->dbc = $dbc;
        $this->tableName = "pages";
        $this->fields = [
            'id',
            'title',
            'content'
        ];
    }

}