<?php
class SBase
{

    public $ID="";
    public $dataArr = array();//for datasets
    public $classArr = array();
    public $tipArr = array();
    public $styleArr = array();
    public $parentToString;
    //input
    public $type="";
    public $value="";
    public $name="";
    //label
    public $for="";
    //form
    public $action="";
    public $method="";


    public function __construct()
    {

    }
//********************************************************
    public function parentToString()
    {
        $ret = "";
        $id_string = $this->getIDString();
        $class_string = $this->getClassString();
        $tip_string = $this->getTipString();
        $ds_string = $this->getDatasetString();
        $type_string =$this->getTypeString();
        $name_string = $this->getNameString();
        $value_string = $this->getValueString();
        $action_string = $this->getActionString();
        $method_string = $this->getMethodString();
        $style_string = $this->getStyleString();
        $for_string = $this->getForString();
        $ret .= $for_string.$id_string . $class_string . $ds_string.$tip_string.$name_string.$value_string.$type_string.$action_string.$method_string.$style_string;
        $this->parentToString=$ret;

       return  $this->parentToString;
    }


//***************************************************
    public function addStyle($styleString)
    {
        $this->styleArr[] = $styleString;
    }

//***********************************************************
    public function getStyleString()
    {
        $ret = "";
        if(count($this->styleArr,1)>0) {
            $ret = ' style="';
            foreach ($this->styleArr as $key => $val)
            {
                $ret .= ' ' . $val . ';';
            }
            $ret = trim($ret) . '"';
        }
            return $ret;
    }

//*********************************************************
    public function addClass($className)
    {
        $this->classArr[] = $className;
    }
//*********************************************************
    public function addDataset($dataName, $dataVal)
    {
        $this->dataArr[$dataName] = $dataVal;
    }
//*********************************************************
    public function setFor($for)
    {
        $this->for = $for;
    }
//************************************************
    public function getForString()
    {
        $ret = "";
        if($this->for) {
            $ret .= 'for=' . '"' . $this->for . '" ';
        }
        return $ret;
    }

//*********************************************************
    public function setName($name)
    {
        $this->name = $name;
    }
//************************************************
    public function getNameString()
    {
        $ret = "";
        if($this->name) {
            $ret .= 'name=' . '"' . $this->name . '" ';
        }
        return $ret;
    }
//*********************************************************
    public function setID($id)
    {
        $this->ID = $id;
    }
//*********************************************************
    public function setType($type)
    {
        $this->type = $type;
    }
//*********************************************************
    public function setAction($action)
    {
        $this->action = $action;
    }
//************************************************
    public function getActionString()
    {
        $ret = "";
        if($this->action) {
            $ret .= 'action=' . '"' . $this->action . '" ';
        }
        return $ret;
    }
//*********************************************************
    public function setMethod($met)
    {
        $this->method = $met;
    }
//************************************************
    public function getMethodString()
    {
        $ret = "";
        if($this->method) {
            $ret .= 'method=' . '"' . $this->method . '" ';
        }
        return $ret;
    }
//************************************************
    public function getTypeString()
    {
        $ret = "";
        if($this->type) {
            $ret .= 'type=' . '"' . $this->type . '" ';
        }
        return $ret;
    }
//*********************************************************
    public function setValue($value)
    {
        $this->value = $value;
    }

//************************************************
    public function getValueString()
    {
        $ret = "";
        if($this->value) {
            $ret .= 'value=' . '"' . $this->value . '" ';
        }
        return $ret;
    }

//*********************************************************
    public function addTip($tipString)
    {
        $this->tipArr[] = $tipString;
    }

//***********************************************************
    public function getTipString()
    {
        $ret = "";
        if(count($this->tipArr,1)>0) {
            $ret =  ' title="';
            foreach ($this->tipArr as $key => $val) {
                $ret .= $val . ' ';
            }
            $ret = trim($ret) . '"';
        }
        return $ret;
    }
//***********************************************************
    public function getDatasetString()
    {
        $ret = "";
        foreach ($this->dataArr as $key => $val) {
            $ret .= ' ' . 'data-' . $key . "=" . '"' . $val . '"' . ' ';
        }
        return $ret;
    }
//***********************************************
    public function getClassString()
    {
        $ret ="";
        if(count($this->classArr,1)>0) {
            $ret = ' class="';
            foreach ($this->classArr as $key => $val) {
                $ret .= $val . ' ';
            }
            $ret = trim($ret) . '"';
        }
        return $ret;
    }
//************************************************
    public function getIDString()
    {
        $ret = "";
        if($this->ID) {
            $ret .= 'id=' . '"' . $this->ID . '" ';
        }
        return $ret;
    }

}//END Class

?>