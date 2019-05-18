<?php

require_once "./helper/redirect.php";

class Database extends Redirect
{
    public $pdo;
    protected $settings = [];

    public function __construct(array $settings)
    {
        $this->settings = $settings;

        $dns = "mysql:host={$this->settings['hostname']};dbname={$this->settings['database']};charset={$this->settings['charset']}";

        try {
            $this->pdo = new PDO($dns, $this->settings['username'], $this->settings['password'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            $this->where($e->getMessage(), '/', 400);
        }
    }

    public function closeConnect()
    {
        $this->pdo = null;
    }
}