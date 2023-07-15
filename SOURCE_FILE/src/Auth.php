<?php

class Auth {
    private $dbc;
    
    public function __construct($dbc) {
        $this->dbc = $dbc;
    }
    function checkLogin($email, $password){
        $userObj = new User($this->dbc);
        $userObj->findby(['email' => $email]);
        if(property_exists($userObj, 'id')){
            if(password_verify($password, $userObj->password)){
                $rx = [$userObj, true];

                return $rx;
                
            } else {
                $rx = [Null,false];
                return $rx;
            }
        }
    }
    function createUser($value){  
        $userObj = new User($this->dbc);
        $userObj->saveUser($value);
       
    }
    
    function logout(){
        
    }
    
}