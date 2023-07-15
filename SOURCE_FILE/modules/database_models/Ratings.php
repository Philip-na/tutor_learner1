<?php

class Ratings extends Entity {
  

    public function __construct($dbc)
    {
       parent::__construct($dbc, 'ratings');
       
    }
    protected function tableFields(){
        $this->fields = [
            'learnerid',
            'tutorid',
            'point'
        ];
    }

   
}