<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ValidateEmptySpace
 *
 * @author Emorut Deogratius
 */
class ValidateEmptySpace implements ValidationRuleInterface {
    //put your code here
    public function getErrorMessage() {
        return 'can not be null';
    }

    public function validateRule($value) {
        
        if($value === ''){
            return true;
        }
        return false;
        
    }

}
