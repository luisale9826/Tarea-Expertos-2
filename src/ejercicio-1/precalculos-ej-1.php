<?php
include_once "../db/database.php";
include_once "db-ej-1.php";

class PreCalculosEj1
{
    public $data;

    function __construct()
    {
        if ($this->loadData() == null) {
            $this->data = $this->preCalculos();
        } else {
            $this->data = $this->loadData();
        }
    }

    // Este método se encarga do hacer los calculos de m, contar los valor de cada característica,
    // y los probabilidades de las características y guardarlas en un archivo json. 
    private function preCalculos()
    {
        $database = new Database();
        $conn = $database->connect();
        $db1 = new dbEj1();

        $resultados = array();
        $firstCount = $db1->getValuesCount($conn);
        $conn = $database->connect();

        $resultados['values'] = $firstCount;

        $secondCount = $db1->getStyleCount($conn);
        $conn = $database->connect();

        $resultados['styles'] = $secondCount;

        $rows = $db1->getRowsQuantity($conn);

        $resultados['rows'] = $rows;

        $m = count($secondCount);
        $resultados["m"] = $m;

        $nAcom = $secondCount['ACOMODADOR'];
        $nDiv = $secondCount['DIVERGENTE'];
        $nAsi = $secondCount['ASIMILADOR'];
        $nCon = $secondCount['CONVERGENTE'];

        $probStyles = array();
        $probAcom = $nAcom / $rows;
        $probStyles["probACOMODADOR"] = $probAcom;

        $probDiv = $nDiv / $rows;
        $probStyles["probDIVERGENTE"] = $probDiv;

        $probAsi = $nAsi / $rows;
        $probStyles["probASIMILADOR"] = $probAsi;

        $probCon = $nCon / $rows;
        $probStyles["probCONVERGENTE"] = $probCon;

        $resultados["probStyles"] = $probStyles;

        $probValues = array();
        $probVCA = 1 / $firstCount['CA'];
        $probValues["probVCA"] = $probVCA;

        $probVEC = 1 / $firstCount['EC'];
        $probValues["probVEC"] = $probVEC;

        $probVEA = 1 / $firstCount['EA'];
        $probValues["probVEA"] = $probVEA;

        $probVOR = 1 / $firstCount['OR'];
        $probValues["probVOR"] = $probVOR;

        $resultados["probValues"] = $probValues;

        $file  = fopen('calculos-previos-ej-1.json', 'w');
        fwrite($file, json_encode($resultados));
        return $resultados;
    }

    // Este método se encarga de cargar los datos
    // Retorna null si el número de filas en la BD cambio, sino retorna los datos
    public function loadData() {
        $strJsonFileContents = file_get_contents("calculos-previos-ej-1.json");
        $array = json_decode($strJsonFileContents, true);

        $database = new Database();
        $conn = $database->connect();
        $db1 = new dbEj1();
        $rows = $db1->getRowsQuantity($conn);
        if ($array == null || $rows != $array["rows"]) {
            return null;
        }
        return $array;
    }
}
