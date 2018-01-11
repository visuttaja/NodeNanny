<?php
require_once('SNode.php');
class SCell extends SNode
{

    public function __construct($txt="")
    {
        parent::__construct($txt);
        $this->addClass('nanny_td');
    }
//********************************************************
public static function createDivCell($node){
    $td = new SCell();
    $div = new SDiv();
    $div->addNode($node);
    $td->addNode($div);
    return $td;
}
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<td ' . $this->parentToString() . '>' . $ret . '</td>';

        return $ret;
    }

}//END Class

?>