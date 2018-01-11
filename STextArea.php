<?php
require_once('SBase.php');
class STextArea extends SNode
{
//textarea officials
    protected $cols="";
    protected $rows="";
    protected $form="";
//************************************
    protected $txt = "";

    public function __construct()
    {
        parent::__construct();


        $this->addClass('nanny_textarea');

    }
//***************************************************
    public function setRows($rows){$this->rows=$rows;}
    public function setCols($cols){$this->cols=$cols;}
    public function setForm($form){$this->form=$form;}
//****************komposiitit
public function setColsRows($cols,$rows){
    $this->setRows($rows);
    $this->setCols($cols);
}
//**************************************************************************
    public static function formBindedTextarea($name,$form,$text){
        $area = new STextArea();
        $area->txt = $text;
        $area->setName($name);
        $area->setForm($form->ID);
        return $area;
    }
//**************************************************************************
public static function createTextarea($text){
$area = new STextArea();
    $area->txt = $text;
    return $area;
}
//************************************************
    public function getThisString()
    {
        $ret = "";
        if($this->cols) {$ret .= ' cols=' . '"' . $this->cols . '" '; }
        if($this->rows) {
            $ret .= ' rows=' . '"' . $this->rows . '" ';}
        if($this->form) {
            $ret .= ' form=' . '"' . $this->form . '" ';}
        return $ret;
    }
//******************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();

        $ret = '<textarea ' . $this->getThisString(). $this->parentToString() . '>'. $ret .$this->txt. '</textarea>';

        return $ret;
    }
}