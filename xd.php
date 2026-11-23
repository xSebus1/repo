<?php

    abstract class Database implements Sql {

        abstract public function tryToConnect(): boolval;

        abstract public function createRecord();

        abstract public function readRecord($tableName, $sortType, $limit, $id, $columns);

        abstract public function updateRecord($newValue, $changeBy, $id);

        abstract public function deleteRecord($id);


    }

    interface Sql{
        public function findall($id);
        public function find($id);
        public function readone($id);
        public function readfirstten($id);
    }

    class Mysqldb extends Database{
        public $database;

        public function tryToConnect(): boolval {
            try {
                $conn = mysqli_connect("localhost", "root", "", "obiektowka");

                if (mysqli_connect_errno()) {
                    echo "Bład przy lączeniu: ". mysqli_connect_error();
                    throw new Exception('mysqli');
                    return false;
                } else {
                    return true;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function createRecord(...$rowName) {
            if ($bool) {
                $retVal = true;
                try {
                    $sql = "SELECT * FROM nazwa_tabeli WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    foreach ($rName as $rowName) {
                        if (sizeof($rowName) > 4) {
                            $retVal = false;
                        }
                        if ()
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $retVal = false;
                }
            }
            return $retVal;
        }

        public function readRecord($tableName, $sortType, $limit, $id, $columns) {
            $bool = tryToConnect();

            if ($bool) {
                $retVal = true;
                try {
                    $sql = "SELECT * FROM nazwa_tabeli WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $column = [$row];
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $retVal = false;
                }
            }
            return $retVal;
        }

        public function deleteRecord($id) {
            $bool = tryToConnect();

            if ($bool) {
                $retVal = true;
                try {
                    $sql = "DELETE FROM nazwa_tabeli WHERE id = $id";
                    mysqli_query($conn, $sql);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $retVal = false;
                }
            }
            return $retVal;
        }

        public function updateRecord($newValue, $changeBy, $id){
            $bool = tryToConnect();

            if ($bool) {
                $retVal = true;
                try {
                    $sql = "UPDATE nazwa_tabeli ($changeBy) VALUES ($newValue) WHERE id = $id";
                    mysqli_query($conn, $sql);
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $retVal = false;
                }
            }
            return $retVal;
        }



        public function __construct($database) {
            $this->database = $database;
        }
    }


?>
