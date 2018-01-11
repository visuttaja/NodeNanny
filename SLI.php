<?php
require_once('SNode.php');
class SLI extends SNode
{

    public function __construct( )
    {
        parent::__construct();
        $this->addClass('nanny_li');
    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
           $ret = '<li ' . $this->parentToString() . '>' . $ret . '</li>';

            return $ret;
    }

}//END Class

?>