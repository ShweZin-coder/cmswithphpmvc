<?php 
namespace src\interfaces;
interface ValidationRuleInterface{
    public function validateRule($value);
    public function getErrorMessage();
}