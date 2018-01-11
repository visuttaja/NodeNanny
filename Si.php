<?php
require_once('SNode.php');
class Si extends SNode
{



    //*******************************************************
    public function __construct()
    {
        parent::__construct();
        $this->addClass('nanny_i');

    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<i ' . $this->parentToString() .' >' . $ret.'</i>';
        return $ret;
    }

}//END Class

?>
