<?php

const DB_HOST = 'localhost';
const DB_USER = 'user';
const DB_PW = 'user';
const DB_NAME = 'coderschat';

class Connection
{

    private string $dbhost = DB_HOST;
    private string $dbname = DB_NAME;
    private string $dbuser = DB_USER;
    private string $dbpw = DB_PW;

    protected function connect()
    {
        try {
            $dsn = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname;
            $pdo = new PDO($dsn, $this->dbuser, $this->dbpw);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }


    }
}