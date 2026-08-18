<?php 
    require_once dirname(__DIR__)."/Core/Database.php";
    require_once dirname(__DIR__)."/models/Fournisseur.php";

    class FournisseurRepository {

        public function saveFournisseur(Fournisseur $newFournisseur): int {
            $requeteSQL = "INSERT INTO clients(nom, telephone, adresse, email)
                            VALUES (:nom, :telephone, :adresse, :email)";
            return Database::executeUpdate($requeteSQL, [
                'nom' => $newFournisseur->getNom(),
                'telephone' => $newFournisseur->getTelephone(),
                'adresse' =>$newFournisseur->getAdresse(),
                'email' =>$newFournisseur->getEmail(),
            ]);
        }

        public function getAllFournisseur(): array {
            $requeteSQL = "SELECT * FROM fournisseurs";
            $allLignes =  Database::query($requeteSQL, false);

            $fournisseurs = [];

            if (!$allLignes) {
                return [];
            }

            foreach($allLignes as $ligne){
                $fournisseurs[] = $this->arrayToObjet($ligne);
            }
            return $fournisseurs;
        }


        public function arrayToObjet(array $ligne): Fournisseur{
            return new Fournisseur(
                (int)$ligne['id_fournisseur'],
                $ligne['nom'],
                (int)$ligne['telephone'],
                (float)$ligne['adresse'],
                (float)$ligne['email'],
            );
        }

    }