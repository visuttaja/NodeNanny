<?php
require_once('SListNanny.php');
require_once('STestLists.php');
require_once('STableNode.php');
require_once('CI_SGrid.php');

class CI_STree extends SListNanny
{


    public function __construct($id = '')
    {
        parent::__construct($id);

    }
//**********************************************
public function makeQueryTable($q_text,$tis){
    //$q_text = STestLists::querytxt_osaamiselle_projektit(1);
    $table_id = "super_tb";
    $ci_grid = CI_SGrid::gridFromQuery($tis,$table_id,$q_text);
    $grd_table = $ci_grid->toString();
    return $grd_table;
}

}