<?php
require_once('SBase.php');
class SLabel extends SNode
{

protected $txt = "";

    public function __construct($text="")
    {
        parent::__construct();
        $this->txt = $text;

        $this->addClass('nanny_label');

    }

//******************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();

        $ret = '<label ' . $this->parentToString() . '>'. $ret .$this->txt. '</label>';

        return $ret;
    }
}