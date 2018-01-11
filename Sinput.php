<?php
require_once('SNode.php');
class Sinput extends SNode
{
    //*******************************************************
    public function __construct()
    {
        parent::__construct();
    }
//*******************************************************
public static function createInput($id="",$type="",$name="",$value=""){
$but = new Sinput();
    $but->setID($id);
    $but->setType($type);
    $but->setName($name);
    $but->setValue($value);
   return $but;
}
//********************************************************
    public function toString()
    {

        $ret = "";
        $ret = '<input ' . $this->parentToString() .'>' ;
        return $ret;
    }

}//END Class

?>
