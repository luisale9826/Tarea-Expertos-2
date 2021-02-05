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
        <h2>No se implemento</h2>
    </div>
    <form name="final" action="ejercicio-2.php" method="post">
        <br>
        Escriba su Promedio:<input type="number" min="1" name="promedio"><br>
        Estilo:<select name="estilo" value="estilo">
        <option value="averiguar">Averiguar</option>
            <option value="ACOMODADOR">ACOMODADOR</option>
            <option value="DIVERGENTE">DIVERGENTE</option>
            <option value="ASIMILADOR">ASIMILADOR</option>
            <option value="CONVERGENTE">CONVERGENTE</option>
        </select><br>
        Sexo:<select name="sexo" value="sexo">
        <option value="averiguar">Averiguar</option>
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
        </select><br>
        Escoja su recinto:<select name="recinto" value="Recinto">
            <option value="Masculino">Paraíso</option>
            <option value="Masculino">Turrialba</option>
        </select><br>
        <font color="#ff0000">
            <font size="4"> -------------------------------------------------</font>
        </font><input value="Calcular" type="submit" name="submit">
    </form>
    <br>
    <br>
    <a href="javascript:history.back();">Volver</a>
</body>

</html>