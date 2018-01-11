<?php

require_once('SLI.php');
require_once('SUL.php');
require_once('SA.php');
require_once('SALUT.php');

class SListNanny extends SUL
{
    public function __construct($id="")
    {
        parent::setID($id);
        $this->addClass('nanny_ul');
    }
//**********************************************************
    public  function addLiNode($UL , $linkText)
    {

        $new_li = new SLI();
        $a_link=new SA($linkText);
        $new_li ->addNode($a_link);
        $li =  $UL->addNode($new_li);

        return $li;
    }
//********************************************
public function toString()
    {
        $ret = parent::toString();
        return $ret;

    }
//*****************************************************
    public function addToU($child_for_ul){
        return $this->addNode($child_for_ul);
    }
//****************************************************
    public static function addSalut($parent,$title = ""){
        $meta = new SALUT($title);
        $new_meta = $parent->addToU($meta);
        return $new_meta;
    }
//*********************************************************************
public static function addSTableNannyToSalut($parent_salut,$stablenanny){
    //$stablenanny on div
    $li_nyt = SListNanny::addLi($parent_salut);
    //$li_nyt->addStyle('display:none');
    $li_nyt->addNode($stablenanny);
    return $li_nyt;
}
//*********************************************************************
    public static function addSTableNanny($slistnanny,$stablenanny,$open_statement){

        $salut_auki =$slistnanny->addSalut($slistnanny,$open_statement);

        $middle_li = SListNanny::addSTableNannyToSalut($salut_auki,$stablenanny);

        return  $salut_auki;
    }
//*********************************************************
    public static function addLi($parent_salut){
        $li = new SLi();
        $new_li = $parent_salut->addToU($li);
        return $new_li;
    }
//**************************************************************
public static function addLinkToU($ob,$linkText){
   return  $ob->addLinkToU($linkText);
}
//**********************************************************
}

?>
