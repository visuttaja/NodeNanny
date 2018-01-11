<?php
require_once('SNode.php');
class SUL extends SNode
{

    public function __construct()
    {
        parent::__construct();
        $this->addClass('nanny_ul');
    }

//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
      $ret = '<ul ' . $this->parentToString() . '>' . $ret . '</ul>';
        return $ret;
    }

}//END Class

?>