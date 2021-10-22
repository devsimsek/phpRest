<?php

/**
 * ReSQL, A sqlite3 library built on pdo.
 * Copyright smskSoft, mtnsmsk, devsimsek, Metin Şimşek.
 * @package     smskSoft-phpLibs
 * @subpackage  ReSQL
 * @file        ReSQL.php
 * @version     v1.0
 * @author      devsimsek
 * @copyright   Copyright (c) 2021, smskSoft, mtnsmsk
 * @license     https://opensource.org/licenses/MIT	MIT License
 * @link        @no_link_specified
 * @since       Version 1.0
 * @filesource
 */
class ReSQL
{
    /**
     * Library Configuration
     * ReSQL needs some information that will help connect, query from sqlite database file.
     * This config has stdClass structure.
     */
    private stdClass $config;

    /**
     * ReSQL has error storage that will help developers to debug their code.
     * Access this variable with your initialization.
     * Example;
     * $rsql = new ReSQL("dbfile.sql");
     * $rsql->connect()
     * $rsql->error();
     * @var stdClass $error
     */
    protected stdClass $error;

    /**
     * PDO object that will query database
     * @var PDO $pdo
     */
    private PDO $pdo;

    /**
     * @var array $parameters
     */
    private array $parameters = array();

    /**
     * The statement object that will save temporary pdo statement.
     * @var object $statementQuery
     */
    private $statementQuery;

    /**
     * The boolean which has status of connection
     * @var bool $connectionStatus
     */
    public bool $connectionStatus;

    /**
     * @param string $pathToDatabase
     * @param bool $debugMode
     * @throws Exception
     */
    public function __construct(string $pathToDatabase, bool $debugMode = false)
    {
        $this->config = new stdClass();
        $this->config->databasePath = $pathToDatabase;
        $this->config->debug = $debugMode;
        $this->connectionStatus = false;
    }

    /**
     * ReSQL connect
     * Connect to the database specified from
     * @return PDO|stdClass
     * @throws Exception
     */
    public function connect()
    {

        if (file_exists($this->config->databasePath)) {
            try {
                $this->pdo = new \PDO("sqlite:" . $this->config->databasePath);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                $this->ExceptionLog($e->getMessage());
                $this->error = new stdClass();
                $this->error->status = true;
                $this->error->message = "Error, Can't Connect To The Database!";
                $this->connectionStatus = false;
                return $this->error;
            }
            $this->connectionStatus = true;
            return $this->pdo;
        } else {
            $this->ExceptionLog("Error, Database file does not exists!");
            $this->error = new stdClass();
            $this->error->status = true;
            $this->error->message = "Error, Database file does not exists!";
            $this->connectionStatus = false;
            return $this->error;
        }
    }

    /**
     * ReSQL Initialize Connection And Query
     * @param string $query
     * @param array|null $parameters
     * @throws Exception
     */
    protected function _init(string $query, array $parameters = null)
    {
        if ($this->pdo == null) {
            $this->connect();
        }
        try {
            $this->statementQuery = $this->pdo->prepare($query);

            // Add parameters to the parameter array
            $this->bindMore($parameters);

            // Bind parameters
            if (!empty($this->parameters)) {
                foreach ($this->parameters as $param) {
                    $parameters = explode("\x7F", $param);
                    $this->statementQuery->bindParam($parameters[0], $parameters[1]);
                }
            }

            // Execute SQL
            $this->success = $this->statementQuery->execute();
        } catch (\PDOException $e) {
            $this->ExceptionLog($e->getMessage());
            $this->error = new stdClass();
            $this->error->status = true;
            $this->error->message = $e->getMessage();
        }

        $this->parameters = array();
    }

    /**
     * ReSQL bind
     * Add parameter to parameter array
     * @param $para
     * @param $value
     * @return void
     */
    public function bind($para, $value)
    {
        $this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . utf8_encode($value);
    }

    /**
     * ReSQL bindMore
     * Add more parameters to parameter array.
     * @param $pArray
     * @return void
     */
    public function bindMore($pArray)
    {
        if (empty($this->parameters) && is_array($pArray)) {
            $columns = array_keys($pArray);
            foreach ($columns as $i => &$column) {
                $this->bind($column, $pArray[$column]);
            }
        }
    }

    /**
     * ReSQL Query
     * If the SQL query contains a SELECT or SHOW statement it returns
     * an array containing all the result set as row
     * If the SQL statement is a DELETE, INSERT, or UPDATE statement
     * it returns the number of affected rows
     * @param string $query
     * @param array|null $params
     * @param int $fetchMode
     * @return null
     * @throws Exception
     */
    public function query(string $query, array $params = null, int $fetchMode = \PDO::FETCH_ASSOC)
    {

        $query = trim($query);
        $this->_init($query, $params);
        $rawStatement = explode(" ", $query);
        $statement = strtolower($rawStatement[0]);
        if ($statement === 'select' || $statement === 'show') {
            return $this->statementQuery->fetch($fetchMode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->statementQuery->rowCount();
        } else {
            return null;
        }
    }

    /**
     * ReSQL lastInsertId
     * Returns Last Inserted Id
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * ReSQL column
     * Returns an array which represents a column from the result set
     * @param $query
     * @param null $params
     * @return array
     * @throws Exception
     */
    public function column($query, $params = null): array
    {
        $this->_init($query, $params);
        $Columns = $this->statementQuery->fetchAll(PDO::FETCH_NUM);
        $column = null;
        foreach ($Columns as $cells) {
            $column[] = $cells[0];
        }
        return $column;
    }

    /**
     * ReSQL row
     * Returns an array which represents a row from the result set
     * @param $query
     * @param null $params
     * @param int $fetchMode
     * @return mixed
     * @throws Exception
     */
    public function row($query, $params = null, int $fetchMode = PDO::FETCH_ASSOC)
    {
        $this->_init($query, $params);
        return $this->statementQuery->fetch($fetchMode);
    }

    /**
     * ReSQL single
     * Returns the value of one single field/column
     * @param $query
     * @param null $params
     * @return mixed
     * @throws Exception
     */
    public function single($query, $params = null)
    {
        $this->_init($query, $params);
        return $this->statementQuery->fetchColumn();
    }

    /**
     * Returns true if connected
     * @return bool
     */
    public function isConnected(): bool
    {
        return $this->connectionStatus;
    }

    /**
     * ReSQL ExceptionLog
     * Write the log and return the exception if debugging is on
     * @param $message
     * @param string $sql
     * @throws Exception
     */
    private function ExceptionLog($message, string $sql = "")
    {
        if ($this->config->debug) {
            $exception = 'Unhandled Exception. <br />';
            $exception .= $message;
            $exception .= "<br /> You can find the error back in the log.";

            if (!empty($sql)) {
                # Add the Raw SQL to the Log
                $message .= "\r\nRaw SQL : " . $sql;
            }
            throw new Exception($message);
        }
    }

    /**
     * ReSQL has error logger that will help debugging.
     * @return stdClass
     */
    public function error(): stdClass
    {
        if (!isset($this->error)) {
            $this->error = new stdClass();
            $this->error->status = false;
        }
        return $this->error;
    }
}