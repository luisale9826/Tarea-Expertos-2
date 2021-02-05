<?php
    include_once "../db/database.php";
    include_once "../shared.php";
    include_once "precalculos-ej-4.php";


    // Este apartado se recolectan las variable que el usuario ingresó para hacer el calculo

    if ($_POST['submit']) {
        $database = new Database();
        $conn = $database->connect();
        $db4 = new DbEj4;
        $pre = new PreCalculosEj4();
        $data = $pre->data;

        $rel = $_POST['rel'];
        $links = $_POST['links'];
        $cap = $_POST['cap'];
        $cost = $_POST['cost'];

        $probAtt = $data['probAtt'];
        $nClass = $data['countClass'];
        $m = $data['m'];


        $instances = $db4->getClassInstances($conn, $rel, $links, $cap, $cost);
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
        
        echo "La red es de clase {$resultadoFinal} con una probabilidad de {$mayor}";
        echo "<h1>Valores ingresados</h1>";
        echo "Reliability: {$rel}, Number_of_links: {$links}, Capacity: {$cap}, Costo: {$cost}";
        echo "<h1>Cálculos Previos</h1>";
        echo "<h2>M</h2>";
        echo "$m";
        echo "<h2>Número de Filas</h2>";
        $rows = $data['rows'];
        echo "$rows";
        echo "<h2>Cuentas de Reliability, Number_of_links, Capacity, Costo</h2>";
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

        echo "<h2>Probabilidad X Valor(Reliability, Number_of_links, Capacity, Costo)</h2>";
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
