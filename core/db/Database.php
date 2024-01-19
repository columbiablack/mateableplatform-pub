<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\db;

use mateable\core\Platform;
use mysqli;
use PDO;
use PDOException;

class Database
{
    public PDO $pdo;
    public mysqli $mysqli;

    public function __construct(array $config)
    {
        $dbname = $config['dbname'] ?? '';
        $dsn = $config['dsn'] ?? '';
        $port = $config['port'] ?? '';
        $host = $config['host'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $test = $config['testrun'] ?? false;

        if($test === 'true')
        {
            $this->dbFullTest($config);
        }
        else
        {
            try
            {
                //$this->pdo = new PDO($dsn, $user, $password);
                //$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch (\Exception $exception){
                // TODO Add error handler here.
            }
        }
    }

    public function applyMigrations(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();
        $files = scandir(Platform::$ROOT_DIR . '/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        $newMigrations = [];

        foreach($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..')
            {
                continue;
            }

            require_once Platform::$ROOT_DIR.'/migrations/'.$migration;

            $classname = pathinfo($migration, PATHINFO_FILENAME);
            echo 'The Classname is '.$classname.PHP_EOL;
            $instance = new $classname();

            $instance->up();
            $newMigrations[] = $migration;

            if(!empty($newMigrations))
            {
                $this->savedMigrations($newMigrations);
            }
        }
    }

    public function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS mtb_migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations(): bool|array
    {
        $statement = $this->pdo->prepare("SELECT migration FROM mtb_migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function savedMigrations(array $migrations): void
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO mtb_migrations (migration) VALUES
                                       $str
                                       ");
        $statement->execute();
    }

    public function prepare($sql): bool|\PDOStatement
    {
        return Platform::$app->db->pdo->prepare($sql);
    }

    public function dbFullTest($config): void
    {
        $this->sqlDBConnectionTest($config);
        $this->pdoDBConnectionTest($config);
    }

    public function sqlDBConnectionTest(array $config): string|array
    {
        $db = $config['dbname'] ?? '';
        $port = $config['port'] ?? '';
        $host = $config['host'] ?? '';
        $usr = $config['user'] ?? '';
        $pwd = $config['password'] ?? '';

        try
        {
            $mysqldb = new \mysqli($host, $usr, $pwd, $db, $port);
            if($mysqldb)
            {
                //TODO Create a response confirmation
            }
            else
            {
                //TODO Create a response error confirmation
            }
        }
        catch(\mysqli_sql_exception $exception)
        {
            //return Platform::$app->view->renderView('_error',['exception' => $exception->getMessage(), 'exceptiontitle' => $exception->getCode()]);
            die();
        }

        return true;
    }

    public function pdoDBConnectionTest(array $config): string|array
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        try
        {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex)
        {
           // return Platform::$app->view->renderView('_error', ['exception' => $ex->getMessage(), 'exceptiontitle' => $ex->getCode()]);
            throw new \mateable\core\exceptions\PDOException();
        }
        return true;
    }
}