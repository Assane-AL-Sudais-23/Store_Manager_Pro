<?php 

    namespace src\Core;

    use PDO;
    use PDOException;

    class Database {
        private static ?PDO $connexion = null;

        private function __construct(){
            
        }

        private function __clone(){

        }

        public static function getConnexion(): PDO {
            if (self::$connexion === null) {
                self::$connexion = self::connexionDB();
            }

            return self::$connexion;
        }



        private static function connexionDB(): PDO {
            try {
                $dsnPg = "pgsql:host=localhost;port=5432;dbname=store_manager_pro";
                $userPg = "postgres";
                $passPg = "postgres"; 

                $pdo = new PDO($dsnPg, $userPg, $passPg, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);

                return $pdo;

            } catch (PDOException $e) {
                try {
                    $dbPath = dirname(__DIR__) . 'erp.db';
                    $schemaSqlitePath = dirname(__DIR__) . '../docs/schema_sqlite.sql';
                    
                    $sqliteDB = !file_exists($dbPath);

                    $pdo = new PDO("sqlite:" . $dbPath, null, null, [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]);

                    $pdo->exec("PRAGMA foreign_keys = ON;");

                    if ($sqliteDB && file_exists($schemaSqlitePath)) {
                        $sqlScript = file_get_contents($schemaSqlitePath);
                        $pdo->exec($sqlScript);
                    }

                    return $pdo;

                } catch (PDOException $sqliteError) {
                    die("Connexion impossible à PostgreSQL et SQLite. " . $sqliteError->getMessage());
                }
            }
        }
    }