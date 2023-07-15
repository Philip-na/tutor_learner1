<?php
class SubmissionsController extends Controller{
    function runBeforeAction(){
        $this->setaccesslevel('tutor');      
        return $this->checkPermission();
    }
    function defaultAction(){
        $pageObJ = new Page($this->dbc);
        $pageObJ->findBy(['id'=>$this->entityId], '');
        $variable['pageObj'] = $pageObJ;
        $submissionHaddler = new Submissions($this->dbc);
        $tutorid = $_SESSION['user']['id'];
        $courseid = $submissionHaddler->yxz('Courses',["tutorid"=>$tutorid],'id');

        $variable['submissions'] = $submissionHaddler->get_submissions(['courseid'=>$courseid]);

        
        $this->template->view('submissions/tutor/views/submissions',$variable);
    }
}


