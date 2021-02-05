<?php

class dbEj1
{
    // Esta función se encarga de realizar la primera cuenta de los datos CA, EC, EA, OR de la base de datos.
    // Parametros: $conn = conección con la base de datos
    // Retorna: un arreglo con las cuentas;
    public function getValuesCount($conn)
    {
        $sql = "SELECT COUNT(DISTINCT ca) as 'CA', COUNT(DISTINCT ec) as 'EC', COUNT(DISTINCT ea) AS 'EA', COUNT(DISTINCT ors) AS 'OR' FROM recintoestilo";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $conn->close();
            $array = [];
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "CA" => $row['CA'],
                    "EC" => $row['EC'],
                    "EA" => $row['EA'],
                    "OR" => $row['OR']
                );
            }
            return $array;
        } else {
            echo "0 results";
        }
        $conn->close();
        return null;
    }

    // Esta función se encarga de realizar la segunda cuenta de los datos Acomodador, Divergente, 
    // Asimilador, Convergente de la base de datos.
    // Parametros: $conn = conección con la base de datos
    // Retorna: un arreglo con las cuentas;
    public function getStyleCount($conn)
    {
        $sql = "SELECT COUNT(estilo) as 'ACOMODADOR' FROM recintoestilo WHERE(estilo = 'ACOMODADOR')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $array = [];
            while ($row = $result->fetch_assoc()) {
                $array["ACOMODADOR"] = $row['ACOMODADOR'];
            }
        } else {
            echo "0 results";
        }
        $sql = "SELECT COUNT(estilo) as 'DIVERGENTE' FROM recintoestilo WHERE(estilo = 'DIVERGENTE')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $array["DIVERGENTE"] = $row['DIVERGENTE'];
            }
        } else {
            echo "0 results";
        }
        $sql = "SELECT COUNT(estilo) as 'ASIMILADOR' FROM recintoestilo WHERE(estilo = 'ASIMILADOR')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $array["ASIMILADOR"] = $row['ASIMILADOR'];
            }
        } else {
            echo "0 results";
        }
        $sql = "SELECT COUNT(estilo) as 'CONVERGENTE' FROM recintoestilo WHERE(estilo = 'CONVERGENTE')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $array["CONVERGENTE"] = $row['CONVERGENTE'];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        return $array;
    }

    // Esta funcion cuanta la cantidad de filas en la tabla
    // Parametros: $conn = conección con la base de datos
    // Retorna: cantidad de filas
    public function getRowsQuantity($conn)
    {
        $sql = "SELECT COUNT(*) as 'ROWS' FROM recintoestilo";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $conn->close();
                return $row['ROWS'];
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        return null;
    }

    // TODO: hacer las cuentas de CA, EC, EA, OR para cada estilo
    public function getInstancias($conn, $CA, $EC, $EA, $OR)
    {
        $styles = array('ACOMODADOR', 'DIVERGENTE', 'CONVERGENTE', 'ASIMILADOR');
        $values = array('ca' => $CA, 'ec' => $EC, 'ea' => $EA, 'ors' => $OR);
        $frequencies = array();
        foreach ($styles as $style) {
            $results = [];
            foreach ($values as $key => $value) {
                $results[$key] = $this->getFrequencyByStyle($conn, $value, $style, $key);
            }
            $frequencies[$style] = $results;
        }
        $conn->close();
        return $frequencies;
    }

    private function getFrequencyByStyle($conn, $number, $style, $field)
    {
        $sql = "SELECT COUNT(estilo) FROM recintoestilo WHERE(estilo = '$style' && $field = $number)";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return $row['COUNT(estilo)'];
            }
        } else {
            echo "0 results";
        }
    }
}
