<?php
require_once('SNode.php');
require_once('SCell.php');
require_once('SDiv.php');
class STrow extends SNode
{

    public function __construct( )
    {
        parent::__construct();
        $this->addClass('nanny_tr');
    }
//********************************************************
    public function prependCell($cell){
        $this->prependNode($cell);
        return  $cell;
    }
//********************************************************
public function addCell($cell){
    $this->addNode($cell);
    return  $cell;
}

//******************************************************
    public function addDivObjCell($node){
        $td = SCell::createDivCell($node);
        $this->addCell($td);
        return $td;
    }
//******************************************************
    public function addDivCell($text)
    {
    return $this->addDivTextCell($text);
    }
//****************************************
    public function addDivTextCell($text){
    $td = new SCell();
            $this->addCell($td);
            $inner_div = new SDiv();
    $inner_div->setText($text);
            $td->addNode($inner_div);
    return $td;
}

    //******************************************************
    public function addInputCell($text="",$inp_class=""){
        $td = new SCell();
        $this->addCell($td);
        $inner_input = new Sinput();
        $inner_input ->setValue("".$text);
        $inner_input ->addClass($inp_class);
        $prev = $td->addNode($inner_input);
        return $td;
    }
    //******************************************************
    public function addTextareaCell($text="",$given_class_string=""){
        $td = new SCell();
        $this->addCell($td);
        $inner_textarea = new STextArea();
        $inner_textarea ->setValue("".$text);
        $inner_textarea ->addClass($given_class_string);
        $prev = $td->addNode($inner_textarea);
        return $td;
    }


//*******************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<tr ' . $this->parentToString() . '>' . $ret . '</tr>';

        return $ret;
    }

}//END Class

?>
