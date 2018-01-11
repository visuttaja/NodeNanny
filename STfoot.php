<?php
require_once('SNode.php');
class STfoot extends SNode
{
    public $tf_row;
    public function __construct( )
    {
        parent::__construct();
        $this->addClass('nanny_tfoot');
    }
//********************************************************
    public function addFootRow($row){
        $row = $this->addNode($row);
        $this->tf_row =$row;
    }
//********************************************************
    public function toString()
    {

        $ret = "";
if(count($this->tf_row->childNodes)>0){
$ret = $this->childNodesToString();
        $ret = '<tfoot ' . $this->parentToString() . '>' . $ret . '</tfoot>';
    }
        return $ret;
    }

}//END Class

?>