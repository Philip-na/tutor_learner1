<?php
class SubmissionsController extends Controller{
    function runBeforeAction(){
        $this->setaccesslevel('learner');      
        return $this->checkPermission();
    }
    function defaultAction(){
        $pageObJ = new Page($this->dbc);
        $pageObJ->findBy(['id'=>$this->entityId], '');
        $variable['pageObj'] = $pageObJ;

        
        $this->template->view('submissions/learner/views/submissions',$variable);
    }
}


