<?php
require_once('SOption.php');

class SSelect extends SNode
{

    public function __construct()
    {
        parent::__construct();
        $this->addClass('nanny_sel');
    }
//********************************************************
public function addOpt($value="",$text ="",$asetus_ehto){
$opt = new SOption();
    $this->addNode($opt);
    $opt->setValue($value);
    $opt->setText($text);
    if($asetus_ehto)
        if($asetus_ehto == $value){
        $opt->setState(true);
    }
    return $opt;
}
//****************************************

    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<select ' . $this->parentToString() . '>' . $ret . '</select>';

        return $ret;
    }

}//END Class

?>