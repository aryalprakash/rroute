<?php

class CDatabase {

    var $link;
    var $db;
    var $host, $user, $pass;

    function CDatabase($db, $host = "localhost", $user = "", $pass = "") {
        $this->db = $db;
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;

        if ($this->link = mysqli_connect($host, $user, $pass)) {
            return mysqli_select_db($this->link,$db);
        } else {
            return 0;
        }
    }

    /* execute sql query */

    function query($sql) {

        if (!$this->link) {
            return false;
        }

        return mysqli_query( $this->link,$sql);
    }

    function affected_rows() {
        return mysqli_affected_rows($this->link);
        //return mysqli_affected_rows($this->link,$sql);
    }

    function num_rows($q) {
        return mysqli_num_rows($q);
    }
    function fetch_array($q, $result_type = MYSQLI_BOTH) {
        return mysqli_fetch_array($q, $result_type = MYSQLI_BOTH);
    }

    function fetch_object($q) {
        return mysqli_fetch_object($q);
    }

    function data_seek($q, $n) {
        return mysqli_data_seek($q, $n);
    }

    function free_result($q) {
        return mysqli_free_result($q);
    }

    function insert_id() {
        return mysqli_insert_id($this->link);
    }

    function error() {
        return mysqli_error($this->link);
    }

    function error_die($msg = '') {
        die(((empty($msg)) ? '' : $msg . ': ') . $this->error());
    }

    function sql2var($sql) {
        if ((empty($sql)) || (!($query = $this->query($sql)))) {
            return false;
        }

        if ($this->num_rows($query) < 1) {
            return false;
        }

        return $this->result2var($query);
    }

    function result2var($q) {

        if (!($Data = $this->fetch_array($q))) {
            return false;
        }

        $this->free_result($q);

        foreach ($Data as $k => $v) {
            $GLOBALS[$k] = $v;
        }

        return true;
    }

    function sql2array($sql, $keyField = '') {

        if ((empty($sql)) || (!($query = $this->query($sql)))) {
            return false;
        }

        if ($this->num_rows($query) < 1) {
            return false;
        }

        return $this->result2array($query, $keyField);
    }

    function result2array($q, $keyField = '') {

        $Result = array();

        while ($Data = $this->fetch_array($q)) {
            if (empty($keyField)) {
                $Result[] = $Data;
            } else {
                $Result[$Data[$keyField]] = $Data;
            }
        }

        $this->free_result($q);

        return $Result;
    }

    function list_tables() {
        return mysqli_list_tables($this->db, $this->link);
    }

    function list_fields($table_name) {
        return mysqli_list_fields($this->db,$this->link, $table_name);
    }

    function escape($str)
    {
        return mysqli_real_escape_string( $this->link,$str);
    }
}
;
?>