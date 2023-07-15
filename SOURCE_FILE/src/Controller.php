<?php

class Controller{

    protected $entityId;
    public $template;
    public $dbc;
    protected $acesslevel;
    
//    sets the acess level of a given controler
    protected function setaccesslevel($levels) {
        $this->acesslevel = $levels;
    }
       
//    runs all the actions in the controles
   function runAction($actionName){

        $mthd = 'runBeforeAction';
        if (method_exists($this, 'runBeforeAction')){
            $result = $this->$mthd();
            if ($result == false){
                return;
            }
        }
        
        $actionName .= 'Action';
        if (method_exists($this, $actionName)){
            $this->$actionName();
        }else{
            include VIEW_PATH . 'status/404.html';
        }
    }

    public function setEntityId($entityId){
        $this->entityId = $entityId;
    }

    // handel login of iser
    public function loginAction(){   
      // check if the form is submited
      if($_POST['postAction'] ?? 0 == 1){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
          $auth = new Auth($this->dbc);
          $rst = $auth->checkLogin($email, $password);
          if($rst[1] ?? false == true){             
            $_SESSION['is_admin'] = 1;
            $_SESSION['user']['name'] = $rst[0]->username;
            $_SESSION['user']['id'] = $rst[0]->id;
            $_SESSION['user']['role'] = $rst[0]->role;
            $_SESSION['user']['email'] = $rst[0]->email;
            $url = $this->getRedirct($_SESSION['user']['role']);
            header('Location: ' . $url);
            exit();
          }
          $errors = ['username or password wrong'];
          $_SESSION['validation']['errors'] = $errors;
      }

      include VIEW_PATH . 'layout/login.html';
      unset($_SESSION['validation']['errors']);
    }
    
    
 
    function signupAction(){
      if($_POST['postAction'] ?? 0 == 1){
        $email = trim($_POST['email']) ?? '';
        $validation = new Validation();   
        if(!$validation
                ->addRule(new ValidateRecordExist('User','email',$this->dbc))
                ->validate($email)){
                  $_SESSION['validation']['errors'] = $validation->getAllErrorMessages();
        }

        if(($_SESSION['validation']['errors'] ?? '') == ''){
           
          $auth = new Auth($this->dbc);
          
          $auth->createUser($this->prepareUser($_POST));
            
          header('Location: index.php?module=dashboard&action=login');
          
          }
          
      }
      
//       var_dump($_SESSION['validation']['errors']);
      include VIEW_PATH . 'layout/signup.html';
      unset($_SESSION['validation']['errors']);
    }
   
    
    protected function prepareUser($value) {
        $userdata = [];
        $fields = [
            'name',
            'username', 
            'password',
            'email',
            'role',
            'phone',
            'qualifications',
            's_question',
            'answer'
        ];
        foreach ($fields as $v) {
            if(isset($value[$v])){  
                if($v == 'password'){
                 $userdata[$v] = password_hash(trim($value[$v]),PASSWORD_DEFAULT);
                } else {
                  $userdata[$v] = trim($value[$v]);
                }
                
            }
        }
        
        return $userdata;
    }


//    login validations
    protected function loginvalid($username, $password){
   
    }

    // get the where the user is supose to go affter the login
    private function getRedirct($value){
      if($value == 'learner'){
        return "index.php?seo_name=home";
      }
      if($value == 'admin'){
        return "index.php?seo_name=home";   
      }
      if($value == 'tutor'){
        return "index.php?seo_name=home";
      }
    }
    
    
    protected function checkPermission(){
      if($_SESSION['is_admin'] ?? 0 == 1){
        if($_SESSION['user']['role'] === $this->acesslevel){
            return true;
        }
        echo "access dinied";
        die();
    } else {
         header('Location: index.php?module=dashboard&action=login');
         exit();
    }
    }
}