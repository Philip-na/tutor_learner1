<?php
class TutorsController extends Controller{
    function runBeforeAction(){
        $this->setaccesslevel('tutor');      
        return $this->checkPermission();
    }
    function defaultAction(){
        $pageObJ = new Page($this->dbc);
        $pageObJ->findBy(['id'=>$this->entityId], '');
        $variable['pageObj'] = $pageObJ;

        
        $this->template->view('tutors/tutor/views/tutors',$variable);
    }
}


