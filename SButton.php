<?php
require_once('SNode.php');
class SButton extends SNode
{
    //*******************************************************
    public function __construct()
    {
        parent::__construct();
    }
//*******************************************************
    public static function createButton($id="",$type="",$name="",$value=""){
        $but = new SButton();
        $but->setID($id);
        $but->setType($type);
        $but->setName($name);
        $but->setValue($value);
        $but->setText($value);
        return $but;

    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();

        $ret = '<button ' . $this->parentToString() . '>'. $ret . '</button>';

        return $ret;
    }

}//END Class

?>