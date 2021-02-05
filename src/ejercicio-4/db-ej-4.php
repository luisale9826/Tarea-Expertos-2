<?php
class DbEj4 {

    public function getCountAttributes($conn) {
        $sql = "SELECT COUNT(DISTINCT Reliability) as 'Reliability', COUNT(DISTINCT Number_of_links) as 'Number_of_links', COUNT(DISTINCT Capacity) as 'Capacity', COUNT(DISTINCT Costo) as 'Costo' from redes";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $conn->close();
            $array = [];
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "Reliability" => $row['Reliability'],
                    "Number_of_links" => $row['Number_of_links'],
                    "Capacity" => $row['Capacity'],
                    "Costo" => $row['Costo'],
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
        $classes = array('A', 'B');
        $countClass = [];
        foreach ($classes as $value) {
            $sql = "SELECT COUNT(*) as '{$value}' FROM `redes` WHERE (class = '{$value}')";
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

    public function getRowsQuantity($conn)
    {
        $sql = "SELECT COUNT(*) as 'ROWS' FROM redes";
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

    public function getClassInstances($conn, $Reliability, $Number_of_links, $Capacity, $Costo)
    {
        $classes = array('A', 'B');
        $att = array('Reliability' => $Reliability, 'Number_of_links' => $Number_of_links, 'Capacity' => $Capacity, 'Costo' => $Costo);
        $frequencies = [];
        foreach ($classes as $class) {
            $results = [];
            foreach ($att as $key => $value) {
                $results[$key] = $this->getInstancesByClass($conn, $class, $key, $value);
            }
            $frequencies[$class] = $results;
        }
        $conn->close();
        return $frequencies;
    }

    private function getInstancesByClass($conn, $class, $att, $attValue)
    {
        $sql = "SELECT COUNT(Class) FROM redes WHERE(Class = '{$class}' && {$att} = '{$attValue}')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return $row['COUNT(Class)'];
            }
        } else {
            echo "0 results";
        }
    }
}