<?php
    include_once "../db/database.php";
    include_once "../shared.php";
    include_once "precalculos-ej-3.php";

    if ($_POST["submit"]) {

        $database = new Database();
        $conn = $database->connect();
        $db3 = new DbEj3;
        $pre = new PreCalculosEj3();
        $data = $pre->data;

        // Este apartado se recolectan las variable que el usuario ingresó para hacer el calculo

        $A = $_POST["A"];
        $B = $_POST["B"];
        $C = $_POST["C"];
        $D = $_POST["D"];
        $E = $_POST["E"];
        $F = $_POST["F"];
        $G = $_POST["G"];
        $H = $_POST["H"];

        $probAtt = $data['probAtt'];
        $nClass = $data['countClass'];
        $m = $data['m'];


        $instances = $db3->getClassInstances($conn, $A, $B, $C, $D, $E, $F, $G, $H);
        $probabilitiesPorFrecuencia = [];
        foreach ($instances as $key => $value) {
            $probF = [];
            foreach ($value as $key2 => $value) {
                $probF[$key2] = calculoProbabilidad($value, $m, $probAtt[$key2], $nClass[$key]);
            }
            $probabilitiesPorFrecuencia[$key] = $probF;
        }

        $productoFrecuencias = [];
        foreach ($probabilitiesPorFrecuencia as $key => $value) {
                $productoFrecuencia = 1;
                foreach ($value as $keys => $value) {
                        $productoFrecuencia = $productoFrecuencia * $value;
                }
                $productoFrecuencias[$key] = $productoFrecuencia;
        }

        $probClass = $data['probsClass'];
        $probabilidadesFinales = [];
        foreach ($productoFrecuencias as $key => $value) {
                $probabilidadesFinales[$key] = $value * $probClass[$key];
        }

        $resultadoFinal;
        $mayor = 0;
        foreach ($probabilidadesFinales as $key => $value) {
                if ($mayor == 0 || $value > $mayor) {
                        $resultadoFinal = $key;
                        $mayor = $value;
                }
        }
        
        echo "El profesor es de clase {$resultadoFinal} con una probabilidad de {$mayor}";
        echo "<h1>Cálculos Previos</h1>";
        echo "<h2>M</h2>";
        echo "$m";
        echo "<h2>Número de Filas</h2>";
        $rows = $data['rows'];
        echo "$rows";
        echo "<h2>Cuentas de A, B, C, D, E, F, G, H</h2>";
        foreach ($data['countAttributes'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }

        echo "<h2>Cuentas de Clase</h2>";
        foreach ($data['countClass'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }

        echo "<h2>Probabilidad X Clase</h2>";
        foreach ($data['probsClass'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }

        echo "<h2>Probabilidad X Valor(A, B, C, D, E, F, G, H)</h2>";
        foreach ($data['probAtt'] as $key => $value) {
                echo "{$key}: {$value}";
                echo "<br />";
        }
        
        echo "<h1>Instancias:</h1>";
        foreach ($instances as $key => $value) {
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
