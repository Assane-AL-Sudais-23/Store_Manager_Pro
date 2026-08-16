<?php 

    namespace Src\Models\Repository;

    use Src\Models\Entity\Client;
    use Src\Core\Database;


    class ClientRepository {

        public function saveCLient(Client $newClient): int {
            $requeteSQL = "INSERT INTO clients(nom, prenom, adresse, email, limitCredit)
                            VALUES (:nom, :prenom, :adresse, :email, :limitCredit)";
            return Database::executeUpdate($requeteSQL, [
                'nom' => $newClient->getNom(),
                'prenom' => $newClient->getPrenom(),
                'adresse' =>$newClient->getAdresse(),
                'email' =>$newClient->getEmail(),
                'limitCredit' =>$newClient->getLimiteCredit(),
            ]);
        }

        public function  getAllClients(): array {
            $requeteSQL = "SELECT * FROM clients";
            $allLignes =  Database::query($requeteSQL, false);

            $clients = [];

            if (!$allLignes) {
                return [];
            }

            foreach($allLignes as $ligne){
                $clients[] = $this->arrayToObjet($ligne);
            }
            return $clients;
        }

        public function totalClientsSave(): int {
            $requeteSQL = "SELECT COUNT(*) AS total FROM clients";  
            $resultat = Database::query($requeteSQL, true);
            return (int) ($resultat['total'] ?? 0);
        }

        public function arrayToObjet(array $ligne): Client{
            return new Client(
                (int)$ligne['id_client'],
                $ligne['nom'],
                $ligne['prenom'],
                $ligne['adresse'],
                $ligne['email'],
                (float)$ligne['limitCredit'],
            );
        }
    }