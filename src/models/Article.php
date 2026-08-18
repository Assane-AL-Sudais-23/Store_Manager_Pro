<?php 
    require_once "Fournisseur.php";

    // CREATE TABLE articles (
        // idArticle SERIAL PRIMARY KEY,
        // libelle VARCHAR(100) NOT NULL UNIQUE,
        // qteStock INTEGER NOT NULL DEFAULT 0 CHECK (qteStock >= 0),
        // montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0)
    // );

    class Article {
        private ?int $idArticle;
        private string $libelle;
        private int $qteStock;
        private float $prixUnitaire;

        private ?Fournisseur $fournisseur = null;

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

        public function getFournisseur(): ?Fournisseur {
            return $this->fournisseur;
        }

        public function setId(?int $idArticle): void{
            $this->idArticle = $idArticle;
        }

        public function setQteStock(int $qteStock): void{
            if($qteStock < 0){
                $this->exception("La quantite doit etre positif");
            }
            $this->qteStock = $qteStock;
        }

        public function setLibelle(string $libelle): void {
            if(empty($libelle)){
                $this->exception("Le libelle ne doit pas etre vide");
            }
            $this->libelle = $libelle;
        }

        public function setPrixUnitaire(float $prixUnitaire): void {
            if($prixUnitaire < 0){
                $this->exception("Le prix unitaire ne doit pas etre negatif");
            }
            $this->prixUnitaire = $prixUnitaire;
        }

        public function setFournisseur(Fournisseur $fournisseur): void {
            $this->fournisseur = $fournisseur;
        }

        public function ajouterQuantite(int $quantite): void {
            if($quantite <= 0){
                $this->exception("la quantite doit etre positif");
            }
            $this->qteStock += $quantite;
        }

        public function retirerQuantite(int $quantite): void {
            if($quantite <= 0){
                $this->exception("la quantite doit etre positif");
            } else if($quantite > $this->qteStock) {
                $this->exception("Impossible de retirer cette quantite");
            }
            $this->qteStock -= $quantite;
        }

        public function estDisponible(): bool{
            if($this->qteStock > 0){
                return true;
            }
            return false;
        }

        private function exception(string $message) : void {
            throw new Exception($message);
        }

    }
