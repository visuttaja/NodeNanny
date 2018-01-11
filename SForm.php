<?php
require_once('SBase.php');
class SForm extends SNode
{

public $submit ;
    public function __construct()
    {

        parent::__construct();

        $this->addClass('nanny_form');
    }

//*********************************************************************
public static function createIDForm($id){
    $form = new SForm();
    $form ->setID($id);
    return $form;
}
//******************************************************************
public static function createACMEForm($action="",$method=""){
    $form = new SForm();
    $form->setAction($action);
    $form->setMethod($method);
    return $form;
}
//***********************************************
public function addLabel($for_id="",$txt=""){
    $lab = new SLabel($txt);
    $lab->setFor($for_id);
    $this->addNode($lab);
    return $lab;
}
//*******************************************************
public function addTextPut($id="",$title="",$name="",$value=""){
    $input =Sinput::createInput($id,'text',$name,$value);
    $this->addLabel($id,$title);
    $this->addNode($input);
    return $input;
}
//****************************************
    public function addSubmit($id="",$buttonText,$name=""){
        $input = Sinput::createInput($id,'submit',$name,$buttonText);
        $this->submit =$input;
        $this->addNode($input);
        return $input;
    }
//*******************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();

        $ret = '<form ' . $this->parentToString() . '>'. $ret . '</form>';

        return $ret;
    }
}
