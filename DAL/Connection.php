<?php

/**
 * Created by PhpStorm.
 * User: Charly
 * Date: 01/12/2016
 * Time: 14:02
 */
namespace DAL;

class Connection extends \PDO
{
    private $stmt;

    /**
     * Connection constructor.
     * @param $dsn
     * @param $username
     * @param $passwd
     * @throws \Exception
     */
    public function __construct($dsn, $username, $passwd)
    {
        try {
            parent::__construct($dsn, $username, $passwd);
            $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $query
     * @param array $parameters
     * @return bool
     */
    public function executeQuery($query, array $parameters=[])
    {
        $this->stmt = parent::prepare($query);
        foreach ($parameters as $name => $value) {
            $this->stmt->bindValue($name, $value[0], $value[1]);
        }
        return $this->stmt->execute();
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->stmt->fetchall();
    }
}