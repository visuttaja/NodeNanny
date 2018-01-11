<?php
require_once('Sinput.php');
class SCheckBox extends Sinput
{
    public $state = "";
//*******************************************************
    public function __construct()
    {
        parent::__construct();

    }
//*****************************************************
public function setState($state){
    if($state==true){
        $this->state="checked";
    }
    else {
        $this->state="";
    }

}
    public function getState(){
        return $this->state;
    }
//*******************************************************
public static function createCheckBox($state){

        $cb = new SCheckBox();
         $cb->setType("checkbox");
          $cb->setState($state);

        return $cb;

    }
//*****************************************************************


    public function toString()
    {

        $ret = "";
        $ret = '<input ' . $this->parentToString() .' '.$this->getState().'>' ;
        return $ret;

    }

}//END Class
?>
