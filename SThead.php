<?php
require_once('SNode.php');
class SThead extends SNode
{

    public $hrow;
    public function __construct( )
    {
        parent::__construct();
        $this->addClass('nanny_thead');
    }
//********************************************************
public function addHeadRow($row){
   $row = $this->addNode($row);
    $this->hrow =$row;
}
//********************************************************
    public function addHeader($text){
        $nth = new STh();
        $nth->setText($text);
         $this->hrow->addNode($nth);
return $nth;

    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<thead ' . $this->parentToString() . '>' . $ret . '</thead>';

        return $ret;
    }

}//END Class

?>