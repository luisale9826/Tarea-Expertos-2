<?php
class DbEj3
{

    public function getCountAttribute($conn)
    {
        $sql = "SELECT COUNT(DISTINCT a) as 'A', COUNT(DISTINCT b) as 'B', COUNT(DISTINCT c) as 'C' , COUNT(DISTINCT d) as 'D' , COUNT(DISTINCT e) as 'E', COUNT(DISTINCT f) as 'F' , COUNT(DISTINCT g) as 'G', COUNT(DISTINCT h) as 'H' FROM profesores";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $conn->close();
            $array = [];
            while ($row = $result->fetch_assoc()) {
                $array = array(
                    "A" => $row['A'],
                    "B" => $row['B'],
                    "C" => $row['C'],
                    "D" => $row['D'],
                    "E" => $row['E'],
                    "F" => $row['F'],
                    "G" => $row['G'],
                    "H" => $row['H'],
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

    public function getRowsQuantity($conn)
    {
        $sql = "SELECT COUNT(*) as 'ROWS' FROM profesores";
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

    public function getClassInstances($conn, $A, $B, $C, $D, $E, $F, $G, $H)
    {
        $classes = array('Beginner', 'Intermediate', 'Advanced');
        $att = array('A' => $A, 'B' => $B, 'C' => $C, 'D' => $D, 'E' => $E, 'F' => $F, 'G' => $G, 'H' => $H);
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
        $sql = "SELECT COUNT(class) FROM profesores WHERE(class = '{$class}' && {$att} = '{$attValue}')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                return $row['COUNT(class)'];
            }
        } else {
            echo "0 results";
        }
    }
}
