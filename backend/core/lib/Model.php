<?php

class Model
{
    protected $connection;
    protected $table;

    public function __construct()
    {
        $Connection = new Connection;
        $this->connection = $Connection->getConnection();
    }

    function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $sql = $this->connection->prepare($query);
        $sql->execute($data);
        $id = $this->connection->lastInsertId();
        return $id;
    }

    function search($conditions = [])
    {
        $query = "SELECT * FROM {$this->table}";

        if (!empty($conditions)) {
            $where = implode(' AND ', array_map(fn($column) => "{$column} = :{$column}", array_keys($conditions)));
            $query .= " WHERE {$where}";
        }

        $sql = $this->connection->prepare($query);
        $sql->execute($conditions);

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function searchAll($conditions = [])
    {
        $query = "SELECT * FROM {$this->table}";

        if (!empty($conditions)) {
            $where = implode(' AND ', array_map(fn($column) => "{$column} = :{$column}", array_keys($conditions)));
            $query .= " WHERE {$where}";
        }

        $sql = $this->connection->prepare($query);
        $sql->execute($conditions);

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function update($data = [], $conditions = [])
    {
        $filds = [];
        foreach (array_keys($data) as $column) {
            $filds[] = "{$column} = :{$column}";
        }
        $filds_str = implode(', ', $filds);

        $conditions_arr = [];
        foreach (array_keys($conditions) as $column) {
            $conditions_arr[] = "{$column} = :cond_{$column}";
        }
        $conditions_str = implode(' AND ', $conditions_arr);

        $query = "UPDATE {$this->table} SET {$filds_str} WHERE {$conditions_str}";
        $sql = $this->connection->prepare($query);

        $params = [];
        foreach ($data as $key => $value) {
            $params[":{$key}"] = $value;
        }

        foreach ($conditions as $key => $value) {
            $params[":cond_{$key}"] = $value;
        }

        $sql->execute($params);
        return $sql->rowCount();
    }

    function delete($conditions = [])
    {
        $query = "DELETE FROM {$this->table}";

        $where = implode(' AND ', array_map(fn($column) => "{$column} = :{$column}", array_keys($conditions)));
        $query .= " WHERE {$where}";

        $sql = $this->connection->prepare($query);
        $sql->execute($conditions);
        return $sql->rowCount();
    }

    public function __debugInfo(): array
    {
        return get_object_vars($this);
    }
}