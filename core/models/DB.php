<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\models;

    use mateable\core\Platform;

    abstract class DB extends Model
{
    abstract public function tableName(): string;
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
            $result = false;
            Platform::$app->view->renderView('_error', ['exception' => $exception->getMessage(), 'exceptiontitle' => $exception->getCode()]);
        }
        return $result;
    }

    public function update(): bool
    {
        try{
            $tablename = $this->tableName();
            $attributes = $this->attributes();
            $params = array_map(fn($attr)=>":$attr", $attributes);
            // UPDATE `mtb_users` SET `username` = 'JAEL' WHERE `mtb_users`.`id` = 343;
            $statement = $this->prepare("UPDATE '$tablename' Set (". implode(',',$attributes) .") VALUES (". implode(',', $params) .")");
            $statement = $this->prepare("INSERT INTO $tablename (". implode(',',$attributes) .") VALUES (". implode(',', $params) .")");

            foreach ($attributes as $attribute)
            {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $statement->execute();
            $result = true;
        }catch(\PDOException $exception){
            $result = false;
            //$this->log($exception->getMessage().' - '.$exception->getLine());
        }
        return $result;
    }

    public function findOne(array $where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = static::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key => $item)
        {
            $statement->bindvalue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Platform::$app->db->pdo->prepare($sql);
    }

}