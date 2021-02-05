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
    include_once "precalculos-ej-4.php";
    new PreCalculosEj4();
    ?>
    <div>
        <h1>Ejercicio 4</h1>
        <p>Llene el formulario y la aplicación le dará el tipo de red ya sea A o B.</p>
    </div>
    <form action="solucion-ej-4.php" method="post">
        Reliability: <select name="rel">
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        Number of links: <input id="nlinks" type="number" min="1" name="links">
        Capacity: <select name="cap">
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>
        Costo: <select name="cost">
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>
        <input type="submit" value="Calcular" name="submit">
    </form>

    <a href="../../index.php">Volver</a>
    <script>
    
    </script>
</body>

</html>