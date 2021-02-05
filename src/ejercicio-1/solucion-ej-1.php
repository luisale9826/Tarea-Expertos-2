<?php
include_once "../shared.php";
include_once "../db/database.php";
include_once "db-ej-1.php";
include_once "precalculos-ej-1.php";

if ($_POST['submit']) {
        $database = new Database();
        $conn = $database->connect();
        $db1 = new dbEj1();
        $pre = new PreCalculosEj1();
        $data = $pre->data;

        // Este apartado se recolectan las variable que el usuario ingresó para hacer el calculo
        // se suma para obtener los valor de EC, OR, CA y EA que serán utilizados en el algoritmo

        $EC = $_POST['c5'] + $_POST['c9'] + $_POST['c13'] + $_POST['c17'] + $_POST['c25'] + $_POST['c29'];
        $OR = $_POST['c2'] + $_POST['c10'] + $_POST['c22'] + $_POST['c26'] + $_POST['c30'] + $_POST['c34'];
        $CA = $_POST['c7'] + $_POST['c11'] + $_POST['c15'] + $_POST['c19'] + $_POST['c31'] + $_POST['c35'];
        $EA = $_POST['c4'] + $_POST['c12'] + $_POST['c24'] + $_POST['c28'] + $_POST['c32'] + $_POST['c36'];

        $conn = $database->connect();
        $instancias = $db1->getInstancias($conn, $CA, $EC, $EA, $OR);

        $nstyles = $data['styles'];
        $probs = $data['probValues'];
        $m = $data['m'];

        $probabilitiesPorFrecuencia = [];

        foreach ($instancias as $key => $style) {
                $probaF = [];
                foreach ($style as $key2 => $value) {
                        switch ($key2) {
                                case 'ca':
                                        $probaF[$key2] = calculoProbabilidad($value, $m, $probs['probVCA'], $nstyles[$key]);
                                        break;
                                case 'ec':
                                        $probaF[$key2] = calculoProbabilidad($value, $m, $probs['probVEC'], $nstyles[$key]);
                                        break;
                                case 'ea':
                                        $probaF[$key2] = calculoProbabilidad($value, $m, $probs['probVEA'], $nstyles[$key]);
                                        break;
                                case 'ors':
                                        $probaF[$key2] = calculoProbabilidad($value, $m, $probs['probVOR'], $nstyles[$key]);
                                        break;
                        }
                }
                $probabilitiesPorFrecuencia[$key] = $probaF;
        }

        $productoFrecuencias = [];
        foreach ($probabilitiesPorFrecuencia as $key => $value) {
                $productoFrecuencia = 1;
                foreach ($value as $keys => $value) {
                        $productoFrecuencia = $productoFrecuencia * $value;
                }
                $productoFrecuencias[$key] = $productoFrecuencia;
        }

        $probStyles = $data['probStyles'];
        $probabilidadesFinales = [];
        foreach ($productoFrecuencias as $key => $value) {
                $probabilidadesFinales[$key] = $value * $probStyles["prob{$key}"];
        }

        $resultadoFinal;
        $mayor = 0;
        foreach ($probabilidadesFinales as $key => $value) {
                if ($mayor == 0 || $value > $mayor) {
                        $resultadoFinal = $key;
                        $mayor = $value;
                }
        }

        echo "Eres una persona de estilo {$resultadoFinal} con una probabilidad de {$mayor}";
        echo "<h1>Cálculos Previos</h1>";
        echo "<h2>M</h2>";
        echo "$m";
        echo "<h2>Número de Filas</h2>";
        $rows = $data['rows'];
        echo "$rows";
        echo "<h2>Cuentas de CA, EC, EA, OR</h2>";
        foreach ($data['values'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }

        echo "<h2>Cuentas de Estilo</h2>";
        foreach ($data['styles'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }

        echo "<h2>Probabilidad X Estilo</h2>";
        foreach ($data['probStyles'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }

        echo "<h2>Probabilidad X Valor(CA, EC, EA, OR)</h2>";
        foreach ($data['probValues'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }
        
        echo "<h1>Instancias:</h1>";
        foreach ($instancias as $key => $value) {
                echo "{$key}";
                echo "<br />";
                foreach ($value as $key2 => $value) {
                        echo "{$key2}: {$value}";
                        echo "<br />";
                }
        }
        echo "<h1>Probabilidades por frecuencia: </h1>";
        foreach ($probabilitiesPorFrecuencia as $key => $value) {
                echo "{$key}";
                echo "<br />";
                foreach ($value as $key2 => $value) {
                        echo "{$key2}: {$value}";
                        echo "<br />";
                }
        }
        echo "<h1>Producto de frecuencias:</h1>";
        foreach ($productoFrecuencias as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }

        echo "<h1>Probabilidades Finales:</h1>";
        foreach ($probabilidadesFinales as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }
}
?>
