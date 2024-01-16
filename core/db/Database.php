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
            //$this->log("Running test..");
            $this->dbFullTest($config);
        }
        else
        {
            try
            {
                $this->pdo = new PDO($dsn, $user, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $ex)
            {
              //Controller::renderView('_error', ['exception' => $ex->getMessage(), 'exceptiontitle' => $ex->getCode()]);
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

            //$this->log('applying migrations'.PHP_EOL);
            $instance->up();
            //$this->log('applied migrations'.PHP_EOL);
            $newMigrations[] = $migration;

            if(!empty($newMigrations))
            {
                $this->savedMigrations($newMigrations);
            }
            else
            {
                //$this->log('All migrations have finished');
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

    public function getAppliedMigrations()
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

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function dbFullTest($config): void
    {
        $this->sqlDBConnectionTest($config);
        $this->pdoDBConnectionTest($config);
    }

    public function sqlDBConnectionTest(array $config): void
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
                //$this->log("SQL DB Test(Successful): It seems to have connected with no problems");
            }
            else
            {
                //$this->log("SQL DB Test(Failed): ");
            }
        }
        catch(\mysqli_sql_exception $exception)
        {
            //Platform::$app->view->renderView('_error',['exception' => $exception->getMessage(), 'exceptiontitle' => $exception->getCode()]);
        }

    }

    public function pdoDBConnectionTest(array $config): void
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
            //Platform::$app->view->renderView('_error', ['exception' => $ex->getMessage(), 'exceptiontitle' => $ex->getCode()]);
            //die('<pre>'.json_encode(array('PDO DB Test' => 'failed', 'connection' => false, 'message' => $ex->getMessage())).'</pre>');
        }
    }
}