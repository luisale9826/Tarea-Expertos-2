<?php 
class DBEj2 {
    // Esta función se encarga de realizar la primera cuenta de los datos CA, EC, EA, OR de la base de datos.
    // Parametros: $conn = conección con la base de datos
    // Retorna: un arreglo con las cuentas;
    public function getValuesCount($conn)
    {
        $sql = "SELECT COUNT(DISTINCT sexo) as 'Sexo', COUNT(DISTINCT recinto) as 'Recinto', COUNT(DISTINCT ca) as 'CA', COUNT(DISTINCT ec) as 'EC', COUNT(DISTINCT ea) AS 'EA', COUNT(DISTINCT ors) AS 'OR', COUNT(DISTINCT estilo) as 'Estilo' FROM estilosexopromediorecinto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $conn->close();
            $array = [];
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "Sexo" => $row["Sexo"],
                    "Recinto" => $row['Recinto'],
                    "CA" => $row['CA'],
                    "EC" => $row['EC'],
                    "EA" => $row['EA'],
                    "OR" => $row['OR'],
                    "Estilo" => $row['Estilo']
                );
            }
            return $array;
        } else {
            echo "0 results";
        }
        $conn->close();
        return null;
    }

    public function getCountClass($conn)
    {
        $classes = array('Beginner', 'Intermediate', 'Advanced');
        $countClass = [];
        foreach ($classes as $value) {
            $sql = "SELECT COUNT(*) as '{$value}' FROM `profesores` WHERE (class = '{$value}')";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $countClass[$value] = $row[$value];
                }
            }
        }
        $conn->close();
        return $countClass;
    }
}