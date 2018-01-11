<?php
require_once('STable.php');
require_once('SThead.php');
require_once('STfoot.php');
require_once('STrow.php');
require_once('STbody.php');
require_once('STh.php');
require_once('SCell.php');
require_once('SDiv.php');
require_once('Sinput.php');
require_once('SForm.php');
require_once('SLabel.php');
require_once('STextArea.php');
require_once('SCheckBox.php');
require_once('SSelect.php');
require_once('SButton.php');
require_once('StableAI.php');

class STableNanny extends SDiv
{
    public $table;
    public $thead;
    public $tfoot;
    public $thead_row;
    public $tfoot_row;
    public $tbody;
    public function __construct($id="")
    {
        parent::__construct();
        $this->table = new STable();
        $this->setID($id);
        $this->thead = new SThead();

        $this->table->addNode($this->thead);
        $this->tfoot = new STfoot();
        $this->table->addNode($this->tfoot);

        $this->thead_row = new STrow();
        $this->thead->addHeadRow($this->thead_row);

        $this->tfoot_row = new STrow();
        $this->tfoot->addFootRow($this->tfoot_row);



        $this->tbody = new STbody();
        $this->table->addNode($this->tbody);
        $this->addNode($this->table);
    }
//**************************************************
    public function addBottomButton($buttonID="",$name="",$buttonText="")
    {
        $input = Sinput::createInput($buttonID,'button',$name,$buttonText);
        //add to top of table
        $this->addNode( $input);
        return $input;
    }
//**************************************************
    public function addTopButton($buttonID="",$name="",$buttonText=""){
        $input = Sinput::createInput($buttonID,'button',$name,$buttonText);
        //add to top of table
        $this->addPreNode( $input);
        return $input;
    }
//**************************************************
    public static function getFormButton($buttonID,$buttonText,$link,$method){
        $form = SForm::createACMEForm($link,$method);
        $input = Sinput::createInput($buttonID,'submit',"",$buttonText);
        $form->submit =$input;
        $form->addNode($input);
        //add to top of table
        return $form;
    }
//************************************************
public static function getDivFormButton($buttonID,$buttonText,$link,$method){
    $form_add =  STableNanny::getFormButton($buttonID,$buttonText,$link,$method);
    $wr_div = SDiv::wrapToDiv($form_add);
    $wr_div->addStyle('display:inline-block');
return $wr_div;
}
//**************************************************
    public function addTopFormButton($buttonID,$buttonText,$link,$method){
        $form_but = STableNanny::getFormButton($buttonID,$buttonText,$link,$method);
        //add to top of table
        $this->addPreNode( $form_but);
        return $form_but;
    }
//**************************************************
    public function addBottomFormButton($buttonID,$buttonText,$link,$method)
    {
        $form_but = STableNanny::getFormButton($buttonID,$buttonText,$link,$method);
        //add to top of table
        $this->addNode( $form_but);
        return $form_but;

    }
//*********************************************************
//***CodeIgniter implementation as framework example - query to STableNanny
    public static function CI_nannyFromQueryText($ci_this,$q_text)
    {

        $query_obj = $ci_this->db->query($q_text);

        if(!is_bool ($query_obj )) {

    if ($query_obj) {

        $head_names = $query_obj->list_fields();
        $two_dim_rows = $retarr = $query_obj->result_array();
        //generic part starts here
        $nanny = STableNanny::createFromHeaderAndRows($head_names, $two_dim_rows);
        $arr_th_classes = $nanny->setMysqlHeaderClasses($query_obj->result_id,$nanny );
        return $nanny;
    }
}else{

return $query_obj;
}

    }
//***********************************************************
public static function createFromHeaderAndRows($header_arr,$two_dim_rows_arr){
   $nanny = new STableNanny();

    $nanny->headersFromArray($header_arr);
    $nanny->createRowsFromTwoDimArray($two_dim_rows_arr);
    return $nanny;
}

//***********************************************************
public function createRowsFromTwoDimArray($two_dim){
    foreach ($two_dim as $row_index => $row_now)
    {
        $n_row = $this->addRow();
        foreach ($row_now as $cell_index => $celltext_now)
        {
            $n_row->addDivCell($celltext_now);
        }
    }
}


//********************************************************************
    public function headersFromArrayKeys($arr){

        foreach($arr as $k => $v)
        {
            $this->addHeader($k);
        }
    }
//********************************************************************
    public function footersFromArrayKeys($arr){

        foreach($arr as $k => $v)
        {
            $tf = $this->addFooter($k);

        }
    }

//********************************************************************
    public static function headersFromFetchFields($stn,$mysqli_qob){

        $flds = $mysqli_qob->fetch_fields();
        $types = STableNanny::get_mysqli_field_types( $mysqli_qob);
        $it = 0;
        foreach($flds as $k => $v)
        {
            $th_now =$stn->addHeader($v->name);
            $th_now->mysql_type=$types[$it];
            $th_now->mysql_th=$v->name;
            $val = $v;
            //    $th_now =  $this->addHeader($v);
        ++$it;
        }
        return $stn->thead_row->childNodes;
    }
    //********************************************************************
public function headersFromArray($arr){

    foreach($arr as $k => $v)
    {
       $th_now =  $this->addHeader($v);
    }
}

//********************************************************
    public function removeHeader($index){

        $this->thead_row->removeAt($index);
        return $this->thead_row;
    }
//********************************************************
    public function replaceHeader($index,$text){
        $th = new STh($text);
        $this->thead_row->replaceAt($index,$th);
        return $th;
    }
//********************************************************
    public function insertHeader($index,$text){
        $th = new STh($text);
        $this->thead_row->insertBefore($index,$th);
        return $th;
    }
//********************************************************
    public function prependHeader($text){
        $th = new STh($text);
        $this->thead_row->prependNode($th);
        return $th;
    }
//********************************************************
public function addHeader($text){
    $th = new STh($text);
    $this->thead_row->addNode($th);
    return $th;
}
//********************************************************
public function getRows(){
    return $this->tbody->childNodes;
}
//********************************************************
    public function addRow(){
        $row = new STrow();
        $this->tbody->addNode($row);
        return $row;
    }
//********************************************************
    public function addPreparedRow($row){
        $this->tbody->addNode($row);
        return $row;
    }
//********************************************************
    public function addFooter($text)
    {
        $td = new SCell($text);
        $td->addClass('nanny_tf');
        $this->tfoot_row ->addNode( $td);
        return $td;
    }
//********************************************************
    public function toString()
    {

        $ret = "";

        $ret = $this->childNodesToString();
        $ret = '<div ' . $this->parentToString() . '>' . $ret . '</div>';

        return $ret;
    }

//**************************************************************
    public static function get_mysqli_field_types( $mysqli_result_obj) {
        static $types;
        $ret_types=array() ;
        //$fields = $query_obj->field_data();
        $fieldinfo=mysqli_fetch_fields($mysqli_result_obj);

        if (!isset($types)) {

            $constants = get_defined_constants(true);
            foreach ($constants['mysqli'] as $c => $n)
                if (preg_match('/^MYSQLI_TYPE_(.*)/', $c, $m)) $types[$n] = $m[1];
        }
        foreach ($fieldinfo as $field) {

            $type_id = $field->type;
            $ret_types[] = array_key_exists($type_id, $types)? $types[$type_id] : NULL;
        }
        return $ret_types;
    }
//********************************************************
//asettaa kerätyn tyyppikokoelman
public static function setMysqlHeaderClasses($mysqli_result,$stn){
    $retarr_classes = array();
    $class_types = STableNanny::get_mysqli_field_types($mysqli_result) ;
     $cnt_class_types =count($class_types);
    $cnt_th_size =count($stn->thead_row->childNodes);

    if(!$cnt_class_types===$cnt_th_size){
        echo 'kokoeroa löytyi STableNanny::setMysqlHeaderClasses';
        return;
    }

    for($i=0;$i<$cnt_th_size;++$i){
        $class_now = $class_types[$i];
        $retarr_classes[]=$class_now;
        $a = $stn->thead_row->childNodes[$i]->addClass($class_now);

    }
    return $retarr_classes;

}
//************************************
public static function getMySqlTypesArray($mysqli_result){
    $retarr_classes = array();
    $class_types = STableNanny::get_mysqli_field_types($mysqli_result) ;
    return $class_types;
}

}//END Class
//***************************************************************
//***********************************************
/*
function kuuluuTauluun($str,$taulu)
{
    $ret =  in_array($str, $taulu);
    return $ret;
}
*/
?>
