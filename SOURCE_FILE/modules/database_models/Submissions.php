<?php

class Submissions extends Entity {
  

    public function __construct($dbc)
    {
       parent::__construct($dbc, 'submissions');

        
    }
    protected function tableFields(){
        $this->fields = [
            'studentid',
            'courseid',
            'name',
            'slink',
            'filename'
           
        ];
    }

    public function get_submissions($value = [],$oprt = 'AND'){
        $y = [];
        if(empty($value)){
            $x = $this->findAll();
        }else{
            $x = $this->findAll($value,$oprt);
        }
        foreach($x as $u){
            $obj = (object)[];


            // set defalut fields
            foreach($this->fields as $field){
                $obj->$field = $u->$field ?? '';
            }
            // relelaship Dat
            $obj->id = $u->id;
            $obj->course = $this->yxz("Courses",['id'=>$u->courseid]);
            $obj->learner = $this->yxz("User",['id'=>$u->studentid]);
               
            $y[] = $obj;
        }
        return $y;
    }

   
}