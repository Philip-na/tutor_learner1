<?php
class TutorsController extends Controller{
    function runBeforeAction(){
        $this->setaccesslevel('learner');      
        return $this->checkPermission();
    }
    function defaultAction(){
        $pageObJ = new Page($this->dbc);
        $pageObJ->findBy(['id'=>$this->entityId], '');
        $variable['pageObj'] = $pageObJ;

        $userobj = new User($this->dbc);
        $variable['tutors'] = $userobj->getTutors();
        
        $this->template->view('tutors/learner/views/tutors',$variable);
    }
}


