<?php

namespace App;

use PDO;

class TodoModel
{
    private PDO $dbh;

    public function __construct(array $config)
    {
        $this->dbh = new PDO('mysql:host='.$config['host'].';dbname='. $config['db'],
                             $config['user'], $config['pass']);
    }

    private function executeQuery(string $sql, array $params = [])
    {
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute($params);
    }

    private function fetchData(string $sql, array $params = [], bool $all = false) : array
    {
        $stmt = $this->dbh->prepare($sql);

        $stmt->execute($params);

        return  $all ? $stmt->fetchAll(PDO::FETCH_ASSOC)
                     : $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public  function  getAllWorks() : array
    {
        return $this->fetchData('SELECT * FROM worklist', all: true);
    }

    public function addNewWork(string $newWork)
    {
        $query = "INSERT INTO worklist (work_name, work_status) VALUES (:work_name, :work_status);";

        $params = [
            ':work_name' => $newWork,
            ':work_status' => 0
        ];

        $this->executeQuery($query, $params);
    }

    public function getWorkByID(int $id) : array
    {
        $query = "SELECT * FROM worklist  WHERE id = :id;";

        $params = [
            ':id' => $id
        ];

        return $this->fetchData($query, $params);
    }

    public function updateWorkData(int $id, string $work)
    {
        $query = "UPDATE worklist SET  work_name = :work  WHERE id = :id;";

        $params = [
            ':work' => $work,
            ':id' => $id,
        ];

        $this->executeQuery($query, $params);
    }

    public function changeStatus(array $work)
    {
        $newStatus = 1 - (int)$work['work_status'];

        $query = "UPDATE worklist SET  work_status = :status  WHERE id = :id;";

        $params = [
            ':status' => $newStatus,
            ':id' => $work['id'],
        ];

        $this->executeQuery($query, $params);
    }

    public function delWork(int $id)
    {
        $query = "DELETE FROM worklist WHERE id = :id;";

        $params = [':id' => $id];

        $this->executeQuery($query, $params);
    }
}