<?php
    require_once "Article.php";

    // CREATE TABLE fournisseurs (
    //     id_fournisseur SERIAL PRIMARY KEY,
    //     nom VARCHAR(100) NOT NULL,
    //     telephone VARCHAR(30) NOT NULL UNIQUE,
    //     adresse VARCHAR(150),
    //     email VARCHAR(100) UNIQUE
    // );

    use Exception;

    class Fournisseur {
        private ?int $idFournisseur;
        private string $nom;
        private string $telephone;
        private ?string $adresse;
        private ?string $email;
        private array $articles = [];

        public function __construct(string $nom = '',string $telephone = '',?string $adresse = null,?string $email = null,?int $idFournisseur = null) { 
            $this->idFournisseur = $idFournisseur;
            $this->setNom($nom);
            $this->setTelephone($telephone);
            $this->setAdresse($adresse);
            $this->setEmail($email);
        }

        public function getIdFournisseur(): ?int {
            return $this->idFournisseur;
        }

        public function getNom(): string {
            return $this->nom;
        }

        public function getTelephone(): string {
            return $this->telephone;
        }

        public function getAdresse(): ?string {
            return $this->adresse;
        }

        public function getEmail(): ?string {
            return $this->email;
        }

        public function getArticles(): array {
            return $this->articles;
        }

        public function setIdFournisseur(int $idFournisseur): void {
            $this->idFournisseur = $idFournisseur;
        }

        public function setNom(string $nom): void {
            if (empty($nom)) {
                $this->exception("Le nom du fournisseur ne peut pas être vide.");
            }
            $this->nom = $nom;
        }

        public function setTelephone(string $telephone): void
        {
            if (empty($telephone)) {
                $this->exception("Le numéro de téléphone est obligatoire.");
            }
            $this->telephone = $telephone;
        }

        public function setAdresse(?string $adresse): void {
            $this->adresse = ($adresse !== null && empty($adresse) !== '') ? $adresse : null;
        }

        public function setEmail(?string $email): void{
            if ($email !== null && trim($email) !== '') {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->exception("L'adresse email '$email' n'est pas valide.");
                }
                $this->email = trim($email);
            } else {
                $this->email = null;
            }
        }

        public function setAddArticles(Article $article): void {
            $this->articles[] = $article;
            $article->setFournisseur($this);
        }

        private function exception(string $message): void {
            throw new Exception($message);
        }
    }