<?php
require_once('SNode.php');
class SA extends SNode
{


    public  $href="#";
    //*******************************************************
    public function __construct($linkText="")
    {
        parent::__construct($linkText);
        $this->addClass('nanny_a');

    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<a ' . $this->parentToString() .' href="'.$this->href .'">' . $ret.'</a>';
        return $ret;
    }

}//END Class

?>