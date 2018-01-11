<?php
require_once('SNode.php');
class SSpan extends SNode
{



    //*******************************************************
    public function __construct()
    {
        parent::__construct();
        $this->addClass('nanny_span');

    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<span ' . $this->parentToString() .' >' . $ret.'</span>';
        return $ret;
    }

}//END Class

?>
