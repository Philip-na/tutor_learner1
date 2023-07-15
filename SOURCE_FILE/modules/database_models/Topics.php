<?php

class Topics extends Entity {
  

    public function __construct($dbc)
    {
       parent::__construct($dbc, 'topics');

        
    }
    protected function tableFields(){
        $this->fields = [
           'name',
           'topicdetiles',
           'courseid',
           'createdAt'          
        ];
    }

    public function addTopic($value){
        $v = $this->setPostData($this->setTopicValue($value));
        $this->setValues($v);
        $this->save();
    }

    public function getTopics($value = [],$oprt = 'AND'){
        if(empty($value)){
            $x = $this->findAll();
        }else{
            $x = $this->findAll($value,$oprt);
        }
        return $x;
    }

    private function setTopicValue($value){
        $rest = [];
        foreach($this->fields as $field){
            if($field == 'createdAt'){
                $rest[$field] = date("Y-m-d");
            }else{
                $rest[$field] = $value[$field];
            }
        }
        return $rest;
    }

   
}