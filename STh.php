<?php
require_once('SNode.php');
class STh extends SNode
{

    public function __construct($txt="")
    {
        parent::__construct($txt);

        $this->addClass('nanny_th');

    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<th ' . $this->parentToString() . '>' .$ret . '</th>';

        return $ret;
    }

}//END Class

?>