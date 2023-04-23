<?php 

namespace src\validationRules;
use src\interfaces\ValidationRuleInterface;
class ValidateMaximum implements ValidationRuleInterface{
    private $maximum;
    public function __construct($maximum)
    {
        $this->maximum = $maximum;
    }
    function validateRule($value)
    {
        if(strlen($value) > $this->maximum)
        {
            return false;
        }
        return true;
    }
    function getErrorMessage()
    {
        return "Maximum value is". $this->maximum;
    }
}