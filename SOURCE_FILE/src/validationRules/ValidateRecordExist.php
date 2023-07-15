<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ValidateRecordExist
 *
 * @author Emorut Deogratius
 */
class ValidateRecordExist implements ValidationRuleInterface {
    //put your code here
    private $modulename;
    private $fieldname;
    private $dbc;


    
     public function __construct($table, $field, $dbc)
    {
        $this->modulename = $table;
        $this->fieldname = $field;
        $this->dbc = $dbc;
    }
    public function getErrorMessage() {
        return 'the ' . $this->fieldname . ' already exits';
    }

    public function validateRule($value) {
        $obj = new $this->modulename($this->dbc);
        $obj->findBy([$this->fieldname=>$value],'AND');
        if(property_exists($obj, 'id')){
            return false;
        } else {
         return true;    
        }  
    }

}
