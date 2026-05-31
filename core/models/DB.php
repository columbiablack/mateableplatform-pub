<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;
use PDO;
use PDOException;
use PDOStatement;

abstract class DB extends Model
{
    abstract public static function tableName(): string;
    abstract public function attributes(): array;
    abstract public function primaryKey(): string;

    protected array $whereConditions = [];
    protected array $bindings = [];
    protected ?int $limit = null;
    protected ?int $offset = null;

    /*public function save(): bool
    {
        try{
            $tablename = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr)=>":$attr", $attributes);
            $statement = $this->prepare("INSERT INTO $tablename (". implode(',',$attributes) .") VALUES (". implode(',', $params) .")");

            foreach ($attributes as $attribute)
            {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();
            $result = true;
        }catch(PDOException $exception){
            Platform::$app->session->setFlash('warning', $exception->getMessage());
            Error_Log($exception->getMessage().' - '.$exception->getLine());
            $result = false;
        }
        return $result;
    }*/

    public static function countAll(array $where = []): int
    {
        try {
            $table = static::tableName();
            $sql = "SELECT COUNT(*) FROM {$table}";
            $conditions = [];
            $bindings = [];

            foreach ($where as $column => $value) {
                $param = 'param_' . count($bindings);
                $conditions[] = "{$column} = :{$param}";
                $bindings[$param] = $value;
            }

            if (!empty($conditions)) {
                $sql .= " WHERE " . implode(' AND ', $conditions);
            }

            $stmt = static::prepare($sql);

            foreach ($bindings as $param => $value) {
                $stmt->bindValue(":{$param}", $value);
            }

            $stmt->execute();
            return (int) $stmt->fetchColumn();

        } catch (\Throwable $e) {
            return 0;
        }
    }

    public static function findOne(
        array $where = [],
        ?string $orderBy = null,
        ?int $limit = null
    ): ?static
    {
        $table = static::tableName();
        $sql = "SELECT * FROM $table";

        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "$key = :$key";
            }
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }

        if ($limit) {
            $sql .= " LIMIT $limit";
        }

        $stmt = static::prepare($sql);

        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetch() ?: null;
    }

    public static function findAll(
        array $where = [],
        ?string $orderBy = null,
        ?int $limit = null,
        ?int $offset = null
    ): array
    {
        $table = static::tableName();
        $sql = "SELECT * FROM $table";

        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "$key = :$key";
            }
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }

        if ($limit !== null) {
            $sql .= " LIMIT $limit";
            if ($offset !== null) {
                $sql .= " OFFSET $offset";
            }
        }

        $stmt = static::prepare($sql);

        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function findAllVid(array $where = [], int $limit = 0, int $offset = 0): array|bool
    {
        try {
            $tableName = static::tableName();
            $sql = "SELECT * FROM $tableName";

            if (!empty($where)) {
                $attributes = array_keys($where);
                $conditions = implode(" OR ", array_map(fn($attr) => "$attr LIKE :$attr", $attributes));
                $sql .= " WHERE $conditions";
            }

            if ($limit > 0) {
                $sql .= " LIMIT :limit OFFSET :offset";
            }

            $statement = static::prepare($sql);

            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", "%$item%"); // use LIKE for flexible search
            }

            if ($limit > 0) {
                $statement->bindValue(":limit", $limit, PDO::PARAM_INT);
                $statement->bindValue(":offset", $offset, PDO::PARAM_INT);
            }

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (\Exception|\PDOException $e) {
            return false;
        }
    }

    public function remove(): bool
    {
        try {
            $tableName = static::tableName();
            $primaryKey = $this->primaryKey();
            $primaryKeyValue = $this->{$primaryKey};

            $statement = self::prepare("DELETE FROM $tableName WHERE $primaryKey = :$primaryKey");
            $statement->bindValue(":$primaryKey", $primaryKeyValue);
            $statement->execute();

            return true;
        } catch (\Exception|PDOException $e) {
            Platform::$app->session->setFlash('warning', $e->getMessage());
            error_log($e->getMessage() . ' - ' . $e->getLine());
            return false;
        }
    }

    public static function prepare($sql): bool|PDOStatement
    {
        return self::getdatabase()->prepare($sql);
    }

    public function updateUserInfo(string $id): bool
    {
        try{
            $tablename = static::tableName();
            $attributes = $this->attributes();
            $setValues = array_map(fn($attr) => "$attr = :$attr", $attributes);
            $setValuesString = implode(', ', $setValues);

            $statement = $this->prepare("UPDATE $tablename SET $setValuesString WHERE id = $id");

            foreach ($attributes as $attribute)
            {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();
            return true;
        }catch(PDOException $exception){
            return false;
        }
    }

    /* ---------- QUERY BUILDER ---------- */

    public static function where(array $conditions): static
    {
        $instance = new static();

        foreach ($conditions as $column => $value) {
            $param = str_replace('.', '_', $column);
            $instance->whereConditions[] = "$column = :$param";
            $instance->bindings[$param] = $value;
        }

        return $instance;
    }

    public function orWhere(array $conditions): static
    {
        $parts = [];

        foreach ($conditions as $column => $value) {
            $param = str_replace('.', '_', $column);
            $parts[] = "$column = :$param";
            $this->bindings[$param] = $value;
        }

        if (!empty($parts)) {
            $this->whereConditions[] = '(' . implode(' OR ', $parts) . ')';
        }

        return $this;
    }

    public function limit(int $limit, int $offset = 0): static
    {
        $this->limit = $limit;
        $this->offset = $offset;
        return $this;
    }

    /* ---------- FETCHING ---------- */

    public function get(): array
    {
        $table = static::tableName();
        $sql = "SELECT * FROM {$table}";

        if (!empty($this->whereConditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->whereConditions);
        }

        if ($this->limit !== null) {
            $sql .= ' LIMIT ' . $this->limit . ' OFFSET ' . ($this->offset ?? 0);
        }

        $stmt = self::prepare($sql);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function first(): static|false
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? false;
    }

    public function exists(): bool
    {
        $table = static::tableName();
        $sql = "SELECT 1 FROM {$table}";

        if (!empty($this->whereConditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->whereConditions);
        }

        $sql .= ' LIMIT 1';

        $stmt = self::prepare($sql);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return (bool)$stmt->fetchColumn();
    }

    /* ---------- INSERT ---------- */

    public function save(): bool
    {
        $table = static::tableName();
        $attributes = $this->attributes();

        $columns = implode(',', $attributes);
        $params  = implode(',', array_map(fn($a) => ":$a", $attributes));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$params})";
        $stmt = self::prepare($sql);

        foreach ($attributes as $attr) {
            $stmt->bindValue(":$attr", $this->{$attr});
        }

        return $stmt->execute();
    }

    /* ---------- DELETE ---------- */

    public function delete(): bool
    {
        $table = static::tableName();
        $pk = $this->primaryKey();
        $value = $this->{$pk};

        $sql = "DELETE FROM {$table} WHERE {$pk} = :pk";
        $stmt = self::prepare($sql);
        $stmt->bindValue(':pk', $value);

        return $stmt->execute();
    }
}