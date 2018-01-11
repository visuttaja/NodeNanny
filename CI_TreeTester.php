<?php
require_once('SBase.php');
require_once('SNode.php');
require_once('SListNanny.php');
require_once('STableNanny.php');



class CI_TreeTester
{

    public function __construct($id = '')
    {
        parent::__construct($id);

    }

//**********************************************

    public function composeEx($tis,$q_text){
        //SUL
        $SListNanny = new SListNanny("rootti");//extends SUL
        $SListNanny->addClass("klik_hanuri");

        $tutkinnonosa1 = $SListNanny->addNode(new SLI());
        $avaa_tu1_linkki   = $tutkinnonosa1->addNode(new SA("Tutkinnonosa1"));

        $teemat           = $tutkinnonosa1->addNode(new SUL());

        //**synnytä teema alilistat
        $teema1_lista = $teemat->addNode(new SLI());
        $teema2_lista = $teemat->addNode(new SLI());
        //lisää teemojen avauslinkit
        $teema1_linkki   = $teema1_lista->addNode(new SA("Teema1"));
        $teema2_linkki   = $teema2_lista->addNode(new SA("Teema2"));


        //osaamisille lista
        $osaamiset_tm1           = $teema1_lista->addNode(new SUL());
        $osaamiset_tm2           = $teema2_lista->addNode(new SUL());
        //lisää osaamisten 1
        $osaaminen1 = $osaamiset_tm1->addNode(new SLI());
        $o1_linkki   = $osaaminen1->addNode(new SA("O1"));
        //lisää osaamisten 2
        $osaaminen2 = $osaamiset_tm2->addNode(new SLI());
        $o2_linkki   = $osaaminen2->addNode(new SA("O2"));

        $osaamisen_projektit_lista =$osaaminen2->addNode(new SUL());
        $P1_item = $osaamisen_projektit_lista->addNode(new SLI());
        $P2_item = $osaamisen_projektit_lista->addNode(new SLI());
        $P3_item = $osaamisen_projektit_lista->addNode(new SLI());

        $P1_linkki   = $P1_item->addNode(new SA("P1"));
        $P2_linkki   = $P2_item->addNode(new SA("P2"));
        $P3_linkki   = $P3_item->addNode(new SA("P3"));


        $nanny_t = createNannyTableFromQuery($tis,$q_text);


        //$tableData = $table->toString();


        $appButton= '<div ><input id="ehe"  type="button" value="Paina mua"></div>
<div ><input id="ehe"  type="button" value="Paina mua"></div>';
        //$add2= '<div><input id="ehe2" type="button" value="Vedä mua"></div>';


        $nanny_t->addTopButton("but_id","QWERTY");
        $nanny_t->addBottomButton("but_id","JIPID!");

        $projos_lista = $osaaminen1->addNode(new SUL());

        $osaamiset_lista1 = $projos_lista->addNode( $tableNode);



        //$this->pdata['hanuri'] =$SListNanny ->getTradTree();
        $ul =$SListNanny ->toString();
        return $ul;
    }
//***********************************************************
    function createNannyTableFromQuery($tis,$q_text)
    {
        $query_obj = $tis->db->query($q_text);
        $head_names = $query_obj->list_fields();

        $two_dim_rows = $retarr = $query_obj->result_array();
        //framework riippumaton:kaksiulotteiset datat  tr/td -riveiksi
        $nanny = STableNanny::createFromHeaderAndRows($head_names, $two_dim_rows);

        return $nanny;

    }
//************************************************
    public function composeMetaNodes($tis)
    {
//root SUL
        $SListNanny = new SListNanny("rootti");//extends SUL
        $SListNanny->addClass("klik_hanuri");

        $tu1 = new SALUT("Tutkinnonosa1");
        $SListNanny->addNode($tu1);

        $te1 = new SALUT("Te1");
        $tu1->addToU($te1);

        $o1 = new SALUT("O1");
        $te1->addToU($o1);

        $te2 = new SALUT("Te2");
        $tu1->addToU($te2);
        $o2 = new SALUT("O2");
        $te2->addToU($o2);
        $o2 ->addToU(new SA("P1"));
        $o2 ->addToU(new SA("P2"));
        $o2 ->addToU(new SA("P3"));

        $q_text = STestLists::querytxt_osaamiselle_projektit(1);
        $query_obj = $tis->db->query($q_text);
        $head_names =  $query_obj->list_fields();
        $two_dim_rows = $retarr = $query_obj->result_array();
        $nanny = STableNanny::createFromHeaderAndRows($head_names,$two_dim_rows);

        $nanny->addTopButton("ehe","QWERTY");

        $o1->addToU( $nanny);


        $ul =$SListNanny ->toString();
        return $ul;

    }
//**************************************************
    public static function createCustomUITable($tis,$q_text){

        $nanny = STableNanny::CI_nannyFromQueryText($tis,$q_text);
        //add to top of table
        $nanny->addTopButton( 'ehe','Paina miuta1');
        //add to bottom of table
        $nanny->addBottomButton('oho','Tai miuta');
        return $nanny;
    }
//************************************************
    public static function composeTreeMinimalStyle($tis,$q_text)
    {

        $SListNanny = new SListNanny("rootti");//extends SUL
        $SListNanny->addClass("klik_hanuri");

        $tu1 = SListNanny::addSalut($SListNanny,"TuT");//parent,title

        $te1 = SListNanny::addSalut($tu1,"Teema1");
        $o1 = SListNanny::addSalut($te1,"O1");

        $te2 = SListNanny::addSalut($tu1,"Teema2");
        $o2 = SListNanny::addSalut($te2,"O2");

        SListNanny::addLinkToU($o2,"P1");
        //SListNanny::addLinkToU($SListNanny,"Puuapu");
        SListNanny::addLinkToU($o2,"P2");
        SListNanny::addLinkToU($o2,"P3");

        $tableNode = CI_TreeTester::createCustomUITable($tis,$q_text);

        $o1->addToU( $tableNode);

        $ul =$SListNanny ->toString();
        return $ul;

    }
//************************************************************************

    public static function createTestGridBossaNova($x,$y,$table_id){
        $nan=new STableNanny($table_id);
        $ret ="";
         $nan->addHeader('Y ja X');

        for ($h = 1; $h < $x; $h++)
        {
             $nan->addHeader($h);
        }

        for ($j = 1; $j <= $y; $j++)
        {

            $row = $nan->addRow();
            for ($i = 0; $i < $x; $i++)
            {

               if($i===0)
                   $cellNow = $row->addDivCell("OTSIKKO" );
                else
                $cellNow = $row->addDivCell( $i.' '.$j );
            }
        }


        $ret = $nan->toString();
        return $ret;
    }
//**************************************
    public static function html_list(){
        $branch =
            '<ul class="klik_hanuri">
             <li>
                <a href="#">Teema1 </a>
                <ul >
                    <li id = "L1">
                        <a href="#">O1 </a>
                        <ul>
                            <li>
                                <a href="#">P1</a>
                            </li>
                                <li>
                                <a href="#">P2</a>
                            </li>

                            <li>
                                <a href="#">P3</a>
                            </li>

                        </ul>
                    </li>
                 <li id="L2">
                        <a href="#">O2 (1,2,1)</a>
                        <ul>
                            <li>
                                <a href="#">P4</a>
                            </li>

                            <li>
                                <a href="#">P5</a>
                            </li>

                            <li>
                                <a href="#">P3</a>
                            </li>
                         </ul>
                    </li>
                </ul>
            </li>
            </ul>';

        return $branch;
    }
    public static function createTestGridTraditional($x,$y,$table_id){
        $ret = "";
        //$ret.= '<table class="sortable" id="'.$table_id.'">';
        $ret.= '<table id="'.$table_id.'">';
        $ret.='<thead><tr>';
        $ret.= '<th class="th_class">'.'Y ja X'.'</th>';

        for ($i = 0; $i < $x; $i++)
        {
            $ret.= '<th class="th_class">'.$i.'</th>';
        }

        $ret.= '</tr>';
        $ret.= '</thead>';
        $ret.= '<tbody>';
        for ($j = 0; $j < $y; $j++)
        {
            $ret.= '<tr id="'.$j.'">';
            $ret.= '<td>'.'<b>'.$j.'</td>';
            for ($i = 0; $i < $x; $i++)
            {

                $ret.= '<td id="'.$i.'">';
                $ret.= '<div class="td_div">';
                $ret.= $j . $i;
                $ret.= '</div>';
                $ret.= '</td>';

            }
            $ret.= '</tr>';
        }

        $ret.= '</tbody>';
        $ret.= '</table>';


        return $ret;
    }
}