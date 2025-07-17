<?php
// Archivo: app/core/DatabaseConnection.php

class DatabaseConnection {
    private $dbconn;

    public function __construct() {
        // Usamos las constantes de config.php
        $host = DB_HOST; 
        $user = DB_USER;
        $pass = DB_PASSWORD;
        $charset = DB_CHARSET;

        $this->dbconn = oci_connect($user, $pass, $host, $charset);

        if (!$this->dbconn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
    }

    public function getConnection() {
        return $this->dbconn;
    }

    public function closeConnection() {
        if ($this->dbconn) {
            oci_close($this->dbconn);
        }
    }
}
?>