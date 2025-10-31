<?php

/**
 * Copyright (c) 2024. Mateable LLC
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

    public function save(): bool
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
    }

    public static function countAll(array $where = []): int
    {
        try {
            $tableName = static::tableName();
            $sql = "SELECT COUNT(*) as total FROM $tableName";

            if (!empty($where)) {
                $attributes = array_keys($where);
                $conditions = implode(" OR ", array_map(fn($attr) => "$attr LIKE :$attr", $attributes));
                $sql .= " WHERE $conditions";
            }

            $statement = static::prepare($sql);

            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", "%$item%");
            }

            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total'];
        } catch (\Exception|\PDOException $e) {
            return 0;
        }
    }

    public static function findOne($where): mixed
    {
        try{
            $tableName = static::tableName();
            $attributes = array_keys($where);
            $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
            $statement->execute();
            return $statement->fetchObject(static::class);
        }catch(\Exception|PDOException $e){
            //throw new InternalErrorException("[FindOne]something is wrong in the db. <br>". $e->getMessage());
            return false;
        }
    }

    public static function findAll($where): array|bool
    {
        try {
            $tableName = static::tableName();
            $attributes = array_keys($where);
            $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
            $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
            foreach ($where as $key => $item) {
                $statement->bindValue(":$key", $item);
            }
            $statement->execute();
            // Change below to use FETCH_CLASS
            return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (\Exception|PDOException $e) {
            //throw new InternalErrorException("[FindAll]Something is wrong in the db");
            return false;
        }
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
}