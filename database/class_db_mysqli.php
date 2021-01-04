<?php

class DBMysqli implements DBInterface
{
    private $mysqli;

    public function connect($host, $username, $password, $database, $port)
    {
        $mysqli = new mysqli($host, $username, $password, $database, $port);
        /* check connection */
        if (mysqli_connect_errno()) {
            throw new \DatabaseException('', mysqli_connect_error());
        }
        /* activate reporting */
        $driver = new mysqli_driver();
        $driver->report_mode = MYSQLI_REPORT_ALL & ~MYSQLI_REPORT_INDEX;

        return $this->mysqli = $mysqli;
    }

    public function query(string $sql)
    {
        return $this->mysqli->query($sql);
    }

    public function error(): string
    {
        return $this->mysqli->error;
    }

    public function errno(): int
    {
        return $this->mysqli->errno;
    }

    public function numRows($mysqliResult): int
    {
        return $mysqliResult->num_rows;
    }

    public function selectDb($database)
    {
        return $this->mysqli->select_db($database);
    }

    public function fetchAssoc($mysqliResult)
    {
        return $mysqliResult->fetch_assoc();
    }

    public function fetchRow($mysqliResult)
    {
        return $mysqliResult->fetch_row();
    }

    public function fetchArray($mysqliResult, $type)
    {
        if (is_null($type)) {
            $type = MYSQLI_BOTH;
        }
        return $mysqliResult->fetch_array($type);
    }

    public function affectedRows(): int
    {
        return $this->mysqli->affected_rows;
    }

    public function escapeString(string $string): string
    {
        return $this->mysqli->real_escape_string($string);
    }

    public function lastInsertId(): int
    {
        return $this->mysqli->insert_id;
    }


}