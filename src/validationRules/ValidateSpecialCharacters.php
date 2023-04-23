<?php 

namespace src\validationRules;
use src\interfaces\ValidationRuleInterface;
class ValidateSpecialCharacters implements ValidationRuleInterface{
    private $rule;
    public function __construct($rule = "/[a-zA-Z0-9]+/")
    {
        $this->rule = $rule;
    }
    function validateRule($value)
    {
       if(!preg_match($this->rule,$value))
       {
            return false;
       }
       return true;
    }
    function getErrorMessage()
    {
        return "Email format is not correct.";
    }
}