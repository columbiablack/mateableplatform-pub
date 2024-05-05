<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\db;


use mateable\core\Platform;
use PDO;

class Database
{
    public ?PDO $pdo = null;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(): void {
        echo '<p>Getting migrations and applied migrations list..</p>'.PHP_EOL;
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = []; // Initialize as an empty array to collect new migrations
        $files = scandir(Platform::$ROOT_DIR.'/core/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        echo '<p>Migration is fully loaded and has started.</p>'.PHP_EOL;
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue; // Skip the directory pointers
            }

            require_once Platform::$ROOT_DIR . '/core/migrations/' . $migration;
            $classname = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $classname();
            echo '<p>Migrating ' . $classname . '..</p>' . PHP_EOL;
            $instance->up();
            echo '<p>' . $classname . ' successfully migrated!</p>' . PHP_EOL;
            $newMigrations[] = $migration; // Correctly accumulating new migrations
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            echo '<p>All migrations are already applied.</p>'.PHP_EOL;
        }
    }

    private function saveMigrations(array $newMigrations): void {
        // Assuming $this->pdo is your PDO instance
        $values = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $values");
        $statement->execute();
        echo '<p>Saved ' . count($newMigrations) . ' new migrations.</p>'.PHP_EOL;
    }


    public function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations(): bool|array
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    /*
    public function savedMigrations(array $migrations): void
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
                                       $str
                                       ");
        $statement->execute();
    }
    */
    public function prepare($sql): bool|\PDOStatement
    {
        if($this->pdo !== null) {
            return Platform::$app->db->pdo->prepare($sql);
        }else{
            return false;
        }
    }
}