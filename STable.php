<?php
require_once('SNode.php');
class STable extends SNode
{

    public function __construct( )
    {
        parent::__construct();
        $this->addClass('nanny_table');
    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<table ' . $this->parentToString() . '>' . $ret . '</table>';

        return $ret;
    }

}//END Class

?>