<?php
require_once('SBase.php');
class SNode extends SBase
{
    public $text="";
    public  $childNodes=array();
    public $recent = null;
    public function __construct($txt="")
    {
        parent::__construct();
        $this->text=$txt;

    }
//****************************************
    public function removeAt($index){
        unset( $this->childNodes[$index]);
        $this->childNodes = array_values($this->childNodes);
        $ny = $this->childNodes;
    }
//*****************************************************
public function replaceAt($index,$node){
    $this->childNodes[$index]=$node;
}
//*******************************************************
    public function insertBefore($index,$node)
    {

        $insert = array( $node ); // Not necessarily an array
        array_splice( $this->childNodes, $index, 0, $insert );
        $stop =0;

    }
//************************************************************
    public function prependNode($child)
    {
        array_unshift($this->childNodes,$child);
        $this->recent = $child;
        return $child;
    }

//************************************************************
    public function addNode($child)
    {
        $this->childNodes[]=$child;
        $this->recent = $child;
        return $child;
    }
//**************************************************
public function get_recent(){
    return $this->recent;
}
//************************************************************
    public function addPreNode($child)
    {
        array_unshift($this->childNodes , $child);

        return $child;


    }

//********************************************************
public function setText($text){
    $this->text = $text;
}
//********************************************************
    public function getText(){
      return  $this->text;
    }

//*********************************************************
    public function childNodesToString()
    {
        $ret = "";
        foreach($this->childNodes as $key=>$val)
        {
            $ret.= $val->toString();

        }

        return $this->text.$ret;
    }

}//END Class



?>
