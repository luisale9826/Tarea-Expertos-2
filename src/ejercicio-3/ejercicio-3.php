<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 1</title>
</head>

<body>
    <?php
    include_once "../header-2.php";
    include_once "precalculos-ej-3.php";

    new PreCalculosEj3();
    ?>
    <div>
        <h1>Ejercicio 3</h1>
        <p>
            Llene selecciones las opciones en el formulario que se le presenta en la parte de abajo y se le calculará el tipo de profesor que usted es.

        </p>
    </div>

    <form action="solucion-ej-3.php" method="post">
        A: <select name="A">
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
        </select>
        B: <select name="B">
            <option value="F">F</option>
            <option value="NA">NA</option>
            <option value="M">M</option>
        </select>
        C: <select name="C">
            <option value="I">I</option>
            <option value="B">B</option>
            <option value="A">A</option>
        </select>
        D: <select name="D">
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
        </select>
        E: <select name="E">
            <option value="O">O</option>
            <option value="ND">ND</option>
            <option value="DM">DM</option>
        </select>
        F: <select name="F">
            <option value="A">A</option>
            <option value="H">H</option>
            <option value="L">L</option>
        </select>
        G: <select name="G">
            <option value="O">O</option>
            <option value="S">S</option>
            <option value="N">N</option>
        </select>
        H: <select name="H">
            <option value="O">O</option>
            <option value="S">S</option>
            <option value="N">N</option>
        </select>
        <input type="submit" value="Calcular" name="submit">
    </form>
    <br>
    <br>
    <a href="javascript:history.back();">Volver</a>
</body>

</html>