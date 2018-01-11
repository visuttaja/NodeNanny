<?php
require_once('SBase.php');
class SDiv extends SNode
{


    public function __construct()
    {

        parent::__construct();

        $this->addClass('nanny_div');
    }

//***********************************************************

public static function wrapToDiv($node_to_wrap){
    $new_div = new SDiv();
$new_div->addNode($node_to_wrap);
    return $new_div;
}
//*******************************************************

    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();

        $ret = '<div ' . $this->parentToString() . '>'. $ret . '</div>';

        return $ret;
    }

}