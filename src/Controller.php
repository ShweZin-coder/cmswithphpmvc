<?php 

    namespace src;

    class Controller{
        protected $entityId;
        public $template;
        public $dbc;
        public $log;
        function runAction($actionName)
        {
            if(method_exists($this,'runBeforeAction'))
            {
                $result = $this->runBeforeAction();
                if($result == false)
                {
                    return;
                }
            }
            $actionName .= 'Action';
            if(method_exists($this,$actionName))
            {
                $this->$actionName();

            }
            else
            {
                $variables['title'] = "Sorry";
                $variables['content'] = "We didn't found your page";
                $template = new Template('layout');
                $template->view('static-page',$variables);
            }
        }
        public function setEntityId($entityId)
        {
            $this->entityId = $entityId;
        }
    }
    