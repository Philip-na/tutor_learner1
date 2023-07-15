<?php
class DashboardController extends Controller{
    
    function runBeforeAction(){
       $this->setaccesslevel('learner');      
       return $this->checkPermission();
    }
    
    
    function defaultAction(){
        $pageObJ = new Page($this->dbc);
        $pageObJ->findBy(['id'=>$this->entityId], '');
        $variable['pageObj'] = $pageObJ;

        
        $this->template->view('dashboard/learner/views/dashboard',$variable);
    }
}


