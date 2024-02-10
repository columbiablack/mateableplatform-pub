<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

use mateable\core\Platform;

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
        }catch(\PDOException $exception){
            Platform::$app->session->setFlash('warning', $exception->getMessage());
            Error_Log($exception->getMessage().' - '.$exception->getLine());
            $result = false;
        }
        return $result;
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
        }catch(\PDOException $e){
            echo "something is wrong in the db";
            exit;
        }
    }

    public static function prepare($sql): bool|\PDOStatement
    {
        return Platform::$app->db->prepare($sql);
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
        }catch(\PDOException $exception){
            return false;
        }
    }
}