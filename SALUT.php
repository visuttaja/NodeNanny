<?php
require_once('SNode.php');
require_once('SUL.php');
require_once('SLI.php');
require_once('SA.php');
class SALUT extends SLI
{

public $sul;
public $sa;

    public function __construct($otsikko="")
    {
        parent::__construct();


        $this->sa = new SA($otsikko);
        $this->sul= new SUL();

        $this->addNode($this->sa);
        $this->addNode($this->sul);
        $this->addClass('nanny_salut');

    }
//*****************************************************
    public function addToL($child_for_ul)
    {
        return $this->addNode($child_for_ul);
    }
//*****************************************************
public function addToU($child_for_ul){
    return $this->sul->addNode($child_for_ul);
}
//*****************************************************
    public function addLinkToU($linkText){

return $this->addToU(new SA($linkText));

    }
//********************************************************
    public function toString()
    {

        $ret = "";
        $ret = $this->childNodesToString();
        $ret = '<li ' . $this->parentToString() . '>' . $ret . '</li>';
        return $ret;
    }

}//END Class

?>
