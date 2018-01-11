<?php
require_once('SNode.php');
class SOption extends SNode
{
    public $state = "";
    public function __construct()
    {
        parent::__construct();
        $this->addClass('nanny_opt');
    }

//****************************************
//*****************************************************
    public function setState($state){
        if($state==true){
            $this->state="selected";
        }
        else {
            $this->state="";
        }

    }
//********************************************
    public function getState(){
        return $this->state;
    }
//******************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<option ' . $this->parentToString() . ' '.$this->getState().'>' . $ret . '</option>';

        return $ret;
    }

}//END Class

?>