<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 1</title>
</head>

<body>
    <?php
    include "header-2.php";
    ?>
    <div>
        <h1>Ejercicio 2</h1>
        <p>Llene el formulario y la aplicación le dará el dato que hace falta ya sea el promedio, el sexo, el estilo de aprendizaje o el recinto</p>
    </div>
    <form name="final" action="ejercicio-2.php" method="post">
        <br>
        Escriba su Promedio:<input type="Text" name="promedio"><br>
        Estilo:<select name="estilo" value="estilo">
            <option value="0">Averiguar</option>
            <option value="1">ACOMODADOR</option>
            <option value="2">DIVERGENTE</option>
            <option value="3">ASIMILADOR</option>
            <option value="4">CONVERGENTE</option>
        </select><br>
        Sexo:<select name="sexo" value="sexo">
            <option value="0">Averiguar</option>
            <option value="1">Femenino</option>
            <option value="2">Masculino</option>
        </select><br>
        Escoja su recinto:<select name="recinto" value="Recinto">
            <option value="0">Averiguar</option>
            <option value="5">Paraíso</option>
            <option value="6">Turrialba</option>
        </select><br>
        <font color="#ff0000">
            <font size="4"> -------------------------------------------------</font>
        </font><input value="Calcular" type="submit" name="submit">
    </form>
    <br>
    <?php
    include "shared.php";
    include "database.php";
    if ($_POST["submit"]) {
        $database = new Database();
        $conn = $database->connect();

        // Este apartado se recolectan las variable que el usuario ingresó para hacer el calculo

        $sexo = $_POST["sexo"];
        $promedio = $_POST["promedio"];
        if ($promedio == null) {
            $promedio = 0;
        }
        $estilo = $_POST["estilo"];
        $recinto = $_POST["recinto"];


        $rows = $database->getDataExercise($conn, "estilosexopromediorecinto");

        $bestResult = null;
        $results = [];
        $array = array($sexo, $recinto, $promedio, $estilo);

        // Este fragmento de código se encarga de llamar al algoritmo de Euclides y hacer la estimación
        // Utilizando los datos suministrados por el usuario.
        // Por último muestra el dato no sumistrado por el usuario en pantalla ya sea el promedio, el sexo, el recinto o el estilo de Aprendizaje.
        while ($row = $rows->fetch_assoc()) {
            $comparisonArray = array(getSexo($row['sexo']), getRecinto($row['recinto']), $row['promedio'], getEstilo($row['estilo']));

            if ($sexo == 0) {
                $comparisonArray[0] = $sexo;
            }

            if ($recinto == 0) {
                $comparisonArray[1] = $recinto;
            }

            if ($promedio == 0) {
                $comparisonArray[2] = $promedio;
            }

            if ($estilo) {
                $comparisonArray[3] = $estilo;
            }

            $result = euclides($array, $comparisonArray);
            if ($bestResult == null || $bestResult <= $result) {
                $bestResult = $result;
                $results[0] = $row['sexo'];
                $results[1] = $row['recinto'];
                $results[2] = $row['promedio'];
                $results[3] = $row['estilo'];
            }
        }

        if ($sexo == 0) {
            $res = $results[0];
            echo "Sexo: $res";
        }

        if ($recinto == 0) {
            $res = $results[1];
            echo "Recinto: $res";
        }

        if ($promedio == 0) {
            $res = $results[2];
            echo "Promedio: $res";
        }

        if ($estilo == 0) {
            $res = $results[3];
            echo "Estilo: $res";
        }
    }
    ?>

    <?php

    // Esta función toma el sexo y le otorga un valor numérico para que sea posible utilizarlo en la
    // estimación.
    // Parámetros: El sexo
    // Retorno: el valor numérico que posee el sexo de la persona.
    function getSexo($sexo)
    {
        return $sexo == 'M' ? 1 : 2;
    }

    // Esta función toma el recinto y le otorga un valor numérico para que sea posible utilizarlo en la
    // estimación.
    // Parámetros: El recinto
    // Retorno: el valor numérico que posee el recinto de la persona.
    function getRecinto($recinto)
    {
        return $recinto == 'Paraiso' ? 5 : 6;
    }

    // Esta función toma el estilo de aprendizaje y le otorga un valor numérico para que sea posible utilizarlo en la
    // estimación.
    // Parámetros: El estilo de aprendizaje
    // Retorno: el valor numérico que posee el estilo de aprendizaje de la persona.
    function getEstilo($estilo)
    {
        switch ($estilo) {
            case 'ACOMODADOR':
                return 1;
                break;
            case 'DIVERGENTE':
                return 2;
                break;
            case 'ASIMILADOR':
                return 3;
                break;
            case 'CONVERGENTE':
                return 4;
                break;
        }
    }

    ?>
    <br>
    <a href="../index.php">Volver</a>
</body>

</html>