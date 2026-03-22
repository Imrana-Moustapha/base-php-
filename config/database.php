<?php

namespace Imrana\Test\config;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class database
{
    private string $host;
    private string $username;
    private string $password;
    private string $dbname;
    private int $port;
    private string $charSet;
    private ?PDO $conn = null;

    public function __construct() {
        // 1. Charger le fichier .env qui se trouve au niveau du projet (../)
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // 2. Assigner les valeurs depuis $_ENV                                                          
        $this->host = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->port = (int)$_ENV['DB_PORT'];
        $this->charSet = $_ENV['DB_CHARSET'];
    }

    /**
     * Connexion MySQL
     */
    public function getConnectionMySql(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};port={$this->port};charset={$this->charSet}";
        return $this->connect($dsn);
    }

    /**
     * Connexion PostgreSQL
     */
    public function getConnectionPsql(): PDO
    {
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
        return $this->connect($dsn);
    }

    /**
     * Logique de connexion commune
     */
    private function connect(string $dsn): PDO
    {
        try {
            // On vérifie si une connexion existe déjà pour CETTE instance
            if ($this->conn === null) {
                $this->conn = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
                // echo "<br><br> Connexion etabie";
            }
            return $this->conn;
        } catch (PDOException $th) {
            die("Erreur de connexion : " . $th->getMessage());
        }
    }

    // --- GETTERS & SETTERS (Maintenant détectés par ton extension) ---

    public function getHost(): string {
        return $this->host;
    }

    public function setHost(string $host): void {
        $this->host = $host;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getDbName(): string {
        return $this->dbname;
    }

    public function setDbName(string $dbname): void {
        $this->dbname = $dbname;
    }
}