<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
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

        $newMigrations = [];
        $failedMigrations = [];
        $files = array_values(array_filter(
            scandir(Platform::$ROOT_DIR.'/core/migrations'),
            static fn (string $file): bool => str_ends_with($file, '.php')
        ));
        usort($files, static fn (string $left, string $right): int => strnatcasecmp($left, $right));
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        echo '<p>Migration is fully loaded and has started.</p>'.PHP_EOL;
        foreach ($toApplyMigrations as $migration) {
            $classname = pathinfo($migration, PATHINFO_FILENAME);
            echo '<p>Migrating ' . htmlspecialchars($classname, ENT_QUOTES, 'UTF-8') . '..</p>' . PHP_EOL;

            try {
                require_once Platform::$ROOT_DIR . '/core/migrations/' . $migration;
                $instance = new $classname();
                $instance->up();
                $newMigrations[] = $migration;
                echo '<p>' . htmlspecialchars($classname, ENT_QUOTES, 'UTF-8') . ' successfully migrated!</p>' . PHP_EOL;
            } catch (\Throwable $exception) {
                if ($this->isAlreadyAppliedSchemaChange($exception)) {
                    $newMigrations[] = $migration;
                    echo '<p style="color:#8a6d1d;">' . htmlspecialchars($classname, ENT_QUOTES, 'UTF-8')
                        . ' already applied in the database; recording it as applied.</p>' . PHP_EOL;
                } else {
                    $failedMigrations[$migration] = $exception->getMessage();
                    echo '<p style="color:#b02a37;">' . htmlspecialchars($classname, ENT_QUOTES, 'UTF-8') . ' failed: '
                        . htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>' . PHP_EOL;
                    echo '<p>Continuing with the next migration.</p>' . PHP_EOL;
                }
            }
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        }

        if (empty($newMigrations) && empty($failedMigrations)) {
            echo '<p>All migrations are already applied.</p>'.PHP_EOL;
        }

        if (!empty($failedMigrations)) {
            echo '<h3>Migration failures</h3><ul>';
            foreach ($failedMigrations as $migration => $error) {
                echo '<li><strong>' . htmlspecialchars($migration, ENT_QUOTES, 'UTF-8') . ':</strong> '
                    . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</li>';
            }
            echo '</ul><p>Failed migrations were not marked as applied and will be retried next time.</p>';
        }
    }

    private function isAlreadyAppliedSchemaChange(\Throwable $exception): bool
    {
        $message = strtolower($exception->getMessage());

        return str_contains($message, 'already exists')
            || str_contains($message, 'duplicate column name');
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
        if ($this->pdo === null) {
            throw new \RuntimeException("Database connection not initialized.");
        }

        return $this->pdo->prepare($sql);
    }
}