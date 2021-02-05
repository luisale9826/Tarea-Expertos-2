<?php
include_once "../db/database.php";
include_once "db-ej-4.php";

class PreCalculosEj4 {
    public $data;

    public function __construct()
    {
        if ($this->loadData() == null) {
            $this->data = $this->preCalculos();
        }
        $this->data = $this->loadData();
    }

    private function preCalculos() {
        $database = new Database();
        $conn = $database->connect();
        $db4 = new DbEj4;

        $resultados = array();
        $countAttributes = $db4->getCountAttributes($conn);
        $resultados['countAttributes'] = $countAttributes;

        $conn = $database->connect();
        $countClass = $db4->getCountClass($conn);
        $resultados['countClass'] = $countClass;

        $conn = $database->connect();
        $rows = $db4->getRowsQuantity($conn);
        $resultados['rows'] = $rows;

        $probsClass = $this->getProbClass($rows, $countClass);
        $resultados['probsClass'] = $probsClass;

        $probAtt = $this->getProbAtt($rows, $countAttributes);
        $resultados['probAtt'] = $probAtt;

        $m = count($countAttributes);
        $resultados['m'] = $m;

        
        $file  = fopen('calculos-previos-ej-4.json', 'w');
        fwrite($file, json_encode($resultados));
        return $resultados;
    }


    private function getProbClass($rows, $aClass) {
        $probClass = [];
        foreach ($aClass as $key => $value) {
            $probClass[$key] = $value/$rows;
        }
        return $probClass;
    }

    private function getProbAtt($rows, $aAtt) {
        $probAtt = [];
        foreach ($aAtt as $key => $value) {
            $probAtt[$key] = 1/$value;
        }
        return $probAtt;
    }

    // Este método se encarga de cargar los datos
    // Retorna null si el número de filas en la BD cambio, sino retorna los datos
    public function loadData() {
        $strJsonFileContents = file_get_contents("calculos-previos-ej-4.json");
        $array = json_decode($strJsonFileContents, true);

        $database = new Database();
        $db4 = new DbEj4;
        $conn = $database->connect();
        $rows = $db4->getRowsQuantity($conn);
        if ($array == null || $rows != $array["rows"]) {
            return null;
        }
        return $array;
    }
}