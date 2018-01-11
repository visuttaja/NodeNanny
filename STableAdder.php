<?php
require_once('STableNanny.php');

class STableAdder
{
//***********************************************
    public static function appendCheckColumn($stableNanny ,$title,$given_class_string="",$init_text=""){

        $stableNanny->appendHeader($title);
        foreach($stableNanny->tbody->childNodes as $rownum =>$row_now )
        {
            $td = new SCell();

            $cb = Sinput::createInput('','checkbox',$given_class_string,$init_text);
            $prev = $td->addNode($cb);
            $td = $row_now->addCell($td);

        }

    }

//***********************************************
    public static function prependCheckColumn($stableNanny ,$title,$given_class_string="",$init_text=""){

        $stableNanny->prependHeader($title);
        foreach($stableNanny->tbody->childNodes as $rownum =>$row_now )
        {
            $td = new SCell();

            $cb = Sinput::createInput('','checkbox',$given_class_string,$init_text);
            $prev = $td->addNode($cb);
            $td = $row_now->prependCell($td);


        }

    }
//*********************************************
    public static function insertAllCheckColumns($index,$stableNanny ,$title,$given_class_string="",$init_text=""){

        $header = $stableNanny->insertHeader($index,$title);
        foreach($stableNanny->tbody->childNodes as $rownum =>$row_now )
        {
            $td = new SCell();

            $cb = Sinput::createInput('','checkbox',$given_class_string,$init_text);

            $prev = $td->addNode($cb);
            $row_now-> insertBefore($index,$td);

        }

    }
//*****************************************************************

    public static function insertCheckboxAt($index,$state,$nrow,$given_class_string=""){

        $td = new SCell();

            $cb = SCheckBox::createCheckBox($state);
        $cb->addClass($given_class_string);

            $prev = $td->addNode($cb);
            $nrow-> insertBefore($index,$td);

  return $td;


    }


}//END Class


?>