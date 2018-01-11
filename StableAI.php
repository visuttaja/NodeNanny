<?php
require_once('STableNanny.php');

class STableAI
{
//*****************************************************
    function avainKuuluuTauluun($str,$taulu)
    {
        $ret =  in_array($str, $taulu);
        return $ret;
    }
    //*****************************************************
public static  function kuuluuTauluun($str,$taulu)
    {
        $ret =  in_array($str, $taulu);
        return $ret;
    }



//***************************************************
    function example_definition(){
//pientä joukko oppia:
//ensin määritellään joukko josta otetaan
        $def = new stdClass();
        $def->basic_fields = [
            'Alku Pvm' => 'aloitettu_pvm',
            'Suunnitelma' => 'suunnitelma',
            'Raportti' => 'raportti',
            'Herr Piid' => 'pid'
        ];
        //halutut on $def->basic_fields taulusta
        //vasemmanpuoleisia eli näyttönimiä'
        //joukko-opin jatko:
        // valinnat ovat keskenään poissulkevia
        $def->wanted_plain_fields=[''];
        $def->wanted_text_edits=['Suunnitelma','Raportti'];
        $def->wanted_date_edits=['Alku Pvm'];
        $def->excluded=['pid'];//display excludes
        $def->text_edit_class ='valittu_edit';
        $def->date_input_class ="miun_date_inputit";
        $def->date_td_class ="date_cell";
        $def->plain_class ='not_editable';
        return $def;


    }

//**************************************************
  public  static function fill_empty_row($ptable,$mysqli_qob,$max_rivi,$def){
    $uusi_table = new STableNanny();
      $uusi_table->addClass('projektikimppa');//dateeditin avausperuste
      $uuden_rivi = $uusi_table->addRow();
      $uuden_rivi->addDataset('rivi_muutettu','false');
    $header_row = $ptable->thead_row->childNodes;
    $k = 0;
      foreach ($header_row as $cell_index => $th_now)
      {//sivusuunta, rivin cellit
          $stop =0;

          $otsikko_cls_nyt = $th_now->mysql_type;
          $th_otsikko = $th_now->mysql_th;

          if(kuuluuTauluun($th_otsikko,$def->basic_fields)){
          $stop = 0;
              $otsikko_nyt = array_search ($th_otsikko, $def->basic_fields);
              if(kuuluuTauluun($th_otsikko,$def->excluded)){
                  $k++;
                  continue;
              }

              if(kuuluuTauluun($otsikko_nyt ,$def->wanted_plain_fields)){

                  $cell_now = $uuden_rivi ->addDivTextCell("hihaa");

                  $cell_now->addClass($def->plain_class );
                  $cell_now->addClass($th_otsikko);
                  $uusi_table->addHeader($otsikko_nyt);
                  //$uuden_rivi->addNode($cell_now);
              }

              else if(kuuluuTauluun($otsikko_nyt,$def->wanted_text_edits)){
                  $cell_now = $uuden_rivi ->addDivTextCell("text edit");
                  $cell_now->addClass( $def->text_edit_class );
                  $cell_now->addClass($th_otsikko);
                  $uusi_table->addHeader($otsikko_nyt);
                  //$uuden_rivi->addNode($cell_now);
              }
              /*
              else if(kuuluuTauluun($otsikko_nyt,$def->wanted_plain_dates)){


                  $cell_now = $uuden_rivi ->addDivTextCell($miun_val);
                  $cell_now->addClass($def->date_plain_class );
                  $cell_now->addClass($th_otsikko);
                  $th = $uusi_table->replaceHeader($b,$otsikko_nyt);
                  ++$b;
              }
              */

              else if(kuuluuTauluun($otsikko_nyt,$def->wanted_date_edits)){
              $dat = date( 'Y-m-d H:i:s');
              $pretty = getPrettyDate($dat);
                  if(!kuuluuTauluun($otsikko_nyt,$def->wanted_date_edits_inited)){
                      $pretty ="";
                  }
                  $cell_now = $uuden_rivi ->addInputCell($pretty ,$def->date_input_class);
                  $cell_now->addClass($def->date_td_class);
                  $cell_now->addClass($th_otsikko);
                  $uusi_table->addHeader($otsikko_nyt);
                  //$uuden_rivi->addNode($cell_now);

              }


          }



      }

      return $uusi_table;


    }
//*****************************************
    /**
     *@param STableNanny $stn
     */
    public static function createSingleRowEmptyTable($mysqli_qob,$def ){

        $stn = new STableNanny();
        $headrow = STableNanny::headersFromFetchFields($stn,$mysqli_qob);

        $n_row = $stn->addRow();

        $stn->top_row= $n_row;

        //$def1 = STableAI::example_definition();

        $ntable = STableAI::fill_empty_row($stn,$mysqli_qob,$n_row,$def);
        return $ntable;
    }
    //**************************************************

    public static function fillNannyTableByQueryDef($mysqli_qob,$def ){
//ensin luodaan kyselyn otsikoiden mukainen max kokoinen tyhjä snanny-taulu

        if($mysqli_qob->num_rows==0)
        {

            $table = STableAI::createSingleRowEmptyTable($mysqli_qob ,$def);
            return $table;
        }
        else
        {
            //$table = new STableNanny();
            $table = STableAI::createTableFormRealRows($mysqli_qob,$def );
            return $table;
        }


    }
    //**************************************************
/**
* @param string $q_text
* @param mysqli $mysqli
*/

public static function fillNannyTableByDef($q_text,$mysqli,$def ){
//ensin luodaan kyselyn otsikoiden mukainen max kokoinen tyhjä snanny-taulu

        if(!$mysqli_qob = $mysqli->query($q_text)){
            echo $mysqli->error;
            return false;
        }



        if($mysqli_qob->num_rows==0)
        {

            $table = STableAI::createSingleRowEmptyTable($mysqli_qob ,$def);
            return $table;
        }
        else
            {
            //$table = new STableNanny();
            $table = STableAI::createTableFormRealRows($mysqli_qob,$def );
            return $table;
        }


    }
//*********************************************************
    /**
     *@param STableNanny $stn
     */
    public static function createTableFormRealRows($mysqli_qob,$def ){

        $stn = new STableNanny();
        //next adds mysql_type,mysql_th
        $headrow = STableNanny::headersFromFetchFields($stn,$mysqli_qob);


        //$def = STableAI::test_definition();

        $ntable = STableAI::fill_from_existing_rows($stn,$mysqli_qob,$def);
        return $ntable;
    }
//**************************************************
    /**
     *@param STableNanny $ptable
     */
    public  static function fill_from_existing_rows($ptable,$mysqli_qob,$def){

        $uusi_table = new STableNanny();
        $uusi_table->addClass('projektikimppa');//dateeditin avausperuste
        $num_rows = $mysqli_qob->num_rows;

        for($i=0;$i<$num_rows;++$i){
            $cur_ob = $mysqli_qob->fetch_object();
            $uuden_rivi = $uusi_table->addRow();
            $uuden_rivi->addDataset('rivi_muutettu','false');
            $header_row = $ptable->thead_row->childNodes;
            $b = 0;
            foreach ($header_row as $cell_index => $th_now) {//sivusuunta, rivin cellit
                $otsikko_cls_nyt = $th_now->mysql_type;
                $bth_otsikko = $th_now->mysql_th;
                $th_otsikko = $th_now->mysql_th;


                if(StableAI::kuuluuTauluun($bth_otsikko,$def->basic_fields))
                {
                    $stop = 0;
                    $otsikko_nyt = array_search($bth_otsikko, $def->basic_fields);
                    $ob_ref =strtolower ( $bth_otsikko);


                    if (StableAI::kuuluuTauluun($bth_otsikko, $def->excluded))
                    {
                        //$k++;
                        continue;
                    }
                    if(StableAI::kuuluuTauluun($otsikko_nyt ,$def->wanted_plain_fields)){

                        $miun_val = $cur_ob->{$ob_ref};
                        $cell_now = $uuden_rivi ->addDivTextCell($miun_val);
                        $cell_now->addClass($def->plain_class );
                        $cell_now->addClass($th_otsikko);
                        $th = $uusi_table->replaceHeader($b,$otsikko_nyt);
                        ++$b;

                    }
                    else if(StableAI::kuuluuTauluun($otsikko_nyt,$def->wanted_text_edits))
                    {

                        $miun_val = $cur_ob->{$ob_ref};
                        $cell_now = $uuden_rivi ->addDivTextCell($miun_val);
                        $cell_now->addClass( $def->text_edit_class );
                        $cell_now->addClass($th_otsikko);
                        $th = $uusi_table->replaceHeader($b,$otsikko_nyt);
                        ++$b;


                    }
                    else if(StableAI::kuuluuTauluun($otsikko_nyt,$def->wanted_plain_dates)){

                        $miun_val = $cur_ob->{$ob_ref};
                        if($miun_val==null){

                            $miun_val='';
                        }
                        else{
                            $miun_val = getPrettyDate($miun_val);
                        }

                        $cell_now = $uuden_rivi ->addDivTextCell($miun_val);
                        $cell_now->addClass($def->date_plain_class );
                        $cell_now->addClass($th_otsikko);
                        $th = $uusi_table->replaceHeader($b,$otsikko_nyt);
                        ++$b;
                    }
                    else if(StableAI::kuuluuTauluun($otsikko_nyt,$def->wanted_date_edits)){
                        $miun_val = $cur_ob->{$ob_ref};
                        if($miun_val==null){

                            $miun_val='';
                        }
                        else{
                            $miun_val = getPrettyDate($miun_val);
                        }

//                        $dat = date( 'Y-m-d H:i:s');
                        $cell_now = $uuden_rivi->addInputCell($miun_val ,$def->date_input_class);
                        $cell_now->addClass($def->date_td_class);
                        $cell_now->addClass($th_otsikko);
                        $th = $uusi_table->replaceHeader($b,$otsikko_nyt);

                        ++$b;
                    }

                }

            }

            $stop = 0;
        }








        return $uusi_table;


    }

}

