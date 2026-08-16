<?php 

    // CREATE TABLE articles (
        // idArticle SERIAL PRIMARY KEY,
        // libelle VARCHAR(100) NOT NULL UNIQUE,
        // qteStock INTEGER NOT NULL DEFAULT 0 CHECK (qteStock >= 0),
        // montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0)
    // );

    namespace Src\Models\Entity;

    use Exception;

    class Article {
        private ?int $idArticle;
        private string $libelle;
        private int $qteStock;
        private float $prixUnitaire;

        public function __construct(?int $idArticle = null, string $libelle = '', int $qteStock = 0, float $prixUnitaire = 0.0){
            $this->idArticle = $idArticle;
            $this->libelle = $libelle;
            $this->setQteStock($qteStock);
            $this->setPrixUnitaire($prixUnitaire);
        }

        public function getId(): ?int{
            return $this->idArticle;
        }

        public function getLibelle(): string{
            return $this->libelle;
        }

        public function getQteStock(): int{
            return $this->qteStock;
        }

        public function getPrixUnitaire(): float {
            return $this->prixUnitaire;
        }

        public function setId(?int $idArticle): void{
            $this->idArticle = $idArticle;
        }

        public function setQteStock(int $qteStock): void{
            if($qteStock < 0){
                throw new Exception("La quantite doit etre positif");
            }
            $this->qteStock = $qteStock;
        }

        public function setLibelle(string $libelle): void {
            if(empty($libelle)){
                throw new Exception("Le libelle ne doit pas etre vide");
            }
            $this->libelle = $libelle;
        }

        public function setPrixUnitaire(float $prixUnitaire): void {
            if($prixUnitaire < 0){
                throw new Exception("Le prix unitaire ne doit pas etre negatif");
            }
            $this->prixUnitaire = $prixUnitaire;
        }

        public function ajouterQuantite(int $quantite): void {
            if($quantite <= 0){
                throw new Exception("la quantite doit etre positif");
            }
            $this->qteStock += $quantite;
        }

        public function retirerQuantite(int $quantite): void {
            if($quantite <= 0){
                throw new Exception("la quantite doit etre positif");
            } else if($quantite > $this->qteStock) {
                throw new Exception("Impossible de retirer cette quantite");
            }
            $this->qteStock -= $quantite;
        }

        public function estDisponible(): bool{
            if($this->qteStock > 0){
                return true;
            }
            return false;
        }
    }
