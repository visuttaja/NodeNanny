<?php
require_once('SNode.php');
class STbody extends SNode
{

    public function __construct( )
    {
        parent::__construct();
        $this->addClass('nanny_tbody');
    }
//*********************************************************
public function numRows(){
    if($this->childNodes)
    return count($this->childNodes);
}
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<tbody ' . $this->parentToString() . '>' . $ret . '</tbody>';

        return $ret;
    }

}//END Class

?>