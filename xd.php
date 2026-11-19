<?php

    abstract class Database {

        protected $conn = mysqli_connect("localhost", "root", "", "obiektowka");

        abstract public function tryToConnect(): boolval {
            try {
                $conn;

                if (mysqli_connect_errno()) {
                    echo "Bład przy lączeniu: ". mysqli_connect_error();
                    throw new Exception('mysqli');
                    return tryToConnect(false);
                } else {
                    return tryToConnect(true);
                }
            } catch (Exception e) {
                echo $e->getMessage();
                return tryToConnect(false);
            }
        }

        abstract public function createRecord() {
        }

        abstract public function removeRecord() {

        }
        
        abstract public function updateRecord() {

        }

        abstract public function deleteRecord() {

        }


    }

    class Mysqldb{

    }


?>
