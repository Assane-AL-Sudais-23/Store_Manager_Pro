<?php 

    // CREATE TABLE clients (
    //     id_client SERIAL PRIMARY KEY,
    //     nom VARCHAR(50) NOT NULL,
    //     prenom VARCHAR(50) NOT NULL,
    //     adresse VARCHAR(150) NOT NULL,
    //     email VARCHAR(100) UNIQUE,
    //     limiteCredit NUMERIC(10,2) NOT NULL CHECK (limiteCredit >= 0)
    // );

    namespace Src\Models\Entity;

    use Exception;

    class Client {
        private ?int $idClient;
        private string $nom;
        private string $prenom;
        private string $adresse;
        private string $email;
        private float $limiteCredit;

        public function __construct(?int $idClient, string $nom, string $prenom,string $adresse, string $email, float $limiteCredit){
            $this->idClient = $idClient;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->adresse = $adresse;
            $this->setEmail($email);
            $this->setLimiteCredit($limiteCredit);
        }

        public function getIdClient(): ?int{
            return $this->idClient;
        }

        public function getNom(): string{
            return $this->nom;
        }

        public function getPrenom(): string{
            return $this->prenom;
        }

        public function getAdresse(): string {
            return $this->adresse;
        }

        public function getEmail(): string{
            return $this->email;
        }

        public function getLimiteCredit(): float{
            return $this->limiteCredit;
        }

        public function setId(?int $idClient): void{
            $this->idClient = $idClient;
        }

        public function setNom(string $nom): void{
            if(empty($nom)){
                throw new Exception("le nom ne doit pas etre vide !");
            }
            $this->nom = $nom;
        }

        public function setPrenom(string $prenom): void{
            if(empty($prenom)){
                throw new Exception("le prenom ne doit pas etre vide !");
            }
            $this->prenom = $prenom;
        }

        public function setAdresse(string $adresse): void {
            if(empty($adresse)){
                throw new Exception("L'adresse ne doit pas etre vide !");
            }
            $this->adresse = $adresse;
        }

        public function setEmail(string $email): void{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                throw new Exception("l'email $email n'est pas valide");
            }
            $this->email = $email;
        }

        public function setLimiteCredit(int $limiteCredit): void{
            if($limiteCredit < 0){
                throw new Exception("le credit ne doit pas etre negatif");
            }
            $this->limiteCredit = $limiteCredit;
        }

    }