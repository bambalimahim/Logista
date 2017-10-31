<?php
    require_once "lib/includes.php";
    require_once  "classes/BDD.php";
    class DataHistoGraph {
        public $name;
        public $data;
        public $stack;
        public $slice;

        public function __construct($name="test",$data=array(),$stack=array()) {
            $this->name=$name;
            $this->data=$data;
            $this->stack=$stack;
            $this->slice="TTest";
        }
    }

    $name=BDD::nommageChamp($_SESSION['formStat'][0]);
    for ($i=1; $i<count($_SESSION['formStat']); $i++)
        $name .= "/".BDD::nommageChamp($_SESSION['formStat'][$i]);
    $data[0] = new DataHistoGraph($name,$_SESSION['data'],$_SESSION['champsGraph']);

    

    //$data[0]['name'] = 'Maodo';
    //$data[0]['data'] = [1,3,5,2,6];
    //$data[0]['stack'] = 'Test';
    echo json_encode($data);