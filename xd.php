<?php

    interface SQL{
        public function findAll($id);
        public function find($id);
        public function readOne($id);
        public function readFirstTen($id);
    }

    abstract class Database implements SQL {

        abstract public function tryToConnect(): bool;
        abstract public function createRecord(...$rowName);

        abstract public function readRecord($tableName, $sortType, $limit, $id, $columns);

        abstract public function updateRecord($newValue, $changeBy, $id);
        abstract public function deleteRecord($id);

    }

    class MysqlDB extends Database{
        public $database;

        public function tryToConnect(): bool {
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
            $bool = $this->tryToConnect();

            $retVal = false;
            if ($bool) {
                $retVal = true;
                try {
                    $sql = "SELECT * FROM nazwa_tabeli WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    foreach ($rowName as $rName) {
                        if (sizeof($rowName) > 4) {
                            $retVal = false;
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            return $retVal;
        }

        public function readRecord($tableName, $sortType, $limit, $id, $columns) {
            $bool = $this->tryToConnect();

            $retVal = false;
            if ($bool) {
                $retVal = true;
                try {
                    $sql = "SELECT * FROM $tableName WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $limitIndex = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $column = [$row];
                        if ($limitIndex = $limit) {
                            return;
                        }

                        if ($columns == "all" || "wszystkie") {
                            foreach ($column as $x) {
                                echo $x;
                                $limitIndex++;
                            }
                        }

                        if ($columns = $column) {
                            foreach ($column as $xd) {
                                echo $xd;
                                $limitIndex++;
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            return $retVal;
        }

        public function deleteRecord($id) {
            $bool = tryToConnect();
            $retVal = false;

            if ($bool) {
                $retVal = true;
                try {
                    $sql = "DELETE FROM nazwa_tabeli WHERE id = $id";
                    mysqli_query($conn, $sql);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            return $retVal;
        }

        public function findAll($id) {
            $bool = tryToConnect();
            $retVal;            

            if ($bool) {
                $retVal = true;
                $tables = ["nazwa_tabeli"];
                $tableReturn = [];

                for ($i = 1; $i > sizeof($tables); $i++) {
                    $tableReturn = array_push($tableReturn, $tables[$i]);
                }
            }
            return $retVal; 
        }

        public function find($id) {
            $bool = tryToConnect();
            $retVal;            

            if ($bool) {
                $retVal = true;
                try {
                    $sql = "SELECT * FROM nazwa_tabeli WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $retVal = True;
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $retVal = false;
                }
            }
            return $retVal; 
        }

        public function readOne($id) {
            $bool = tryToConnect();
            $retVal;            

            if ($bool) {
                $retVal = true;
                try {
                    $sql = "SELECT * FROM nazwa_tabeli WHERE id = $id";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($row as $x) {
                            echo $x;
                            if (!empty($x)) {
                                return;
                            }
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $retVal = false;
                }
            }
            return $retVal; 
        }

        public function readFirstTen($id) {
            $bool = tryToConnect();
            $retVal;            

            if ($bool) {
                $retVal = true;
                try {
                    $sql = "SELECT * FROM nazwa_tabeli WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $index = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        foreach ($row as $x) {
                            echo $x;
                            if ($index = 10) {
                                return;
                            } 
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    $retVal = false;
                }
            }
            return $retVal; 
        }

        public function updateRecord($newValue, $changeBy, $id){
            $bool = tryToConnect();
            $retVal;            

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
    }

    $xd = new MysqlDB();
    $xd->createRecord("cos", "tam", "nie", "wiem");
    echo $xd->readRecord("nazwa_tabeli", NULL, 10, 1, 1);
    
?>
