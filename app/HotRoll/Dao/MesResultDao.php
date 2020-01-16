<?php
namespace App\HotRoll\Dao;

use App\HotRoll\Database\Manager;

class MesResultDao
{
    private $db;
    private $tableName;
    private $selectedColumns;
    public function __construct(){
        $this->db = Manager::getDatabase("mes");
        $this->tableName = "RHS_RESULT";
        $this->selectedColumns = [
            "ACTCOILID", "PRODSTART", "PRODEND", "ACTSLABID", "GRADENAME", "HEXIT"
        ];
    }

    public function getDataByTime($line, $startTime, $endTime) {
        $data = $this->db->select($this->tableName, $this->selectedColumns,[
            "PRODSTART[>=]" => $startTime,
            "PRODEND[<=]" => $endTime,
        ]);
        return $data;
    }

    public function getDataByCoilId($coilId) {
        $db = Manager::getDatabase("qms");
        $data = $db->select($this->tableName, "*",[
            "ACTCOILID[=]" => $coilId,
        ]);
        dd(print_r($db));
        return $data;
    }

    public function getInfo(){
        return $this->db->info();
    }

    public function getDatabase(){
        return $this->db;
    }

    public function getExample() {
        $db = Manager::getDatabase("mes");

        $data = $db->select("RHS_RESULT", [
            "ACTCOILID", "PRODSTART", "PRODEND", "ACTSLABID", "GRADENAME", "HEXIT"
        ], [
            "ACTCOILID[=]" => "H110188900",
        ]);
        
        return $data;
    }

}