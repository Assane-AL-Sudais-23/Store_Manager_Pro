<?php
    require_once "Commande.php";
    require_once "Paiement.php";

    // CREATE TABLE dettes (
    //     id_dette SERIAL PRIMARY KEY,
    //     dateCreation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    //     montantInitial NUMERIC(10,2) NOT NULL CHECK (montantInitial >= 0),
    //     commande_id INT NOT NULL REFERENCES commandes(id_commande) ON DELETE CASCADE
    // );

    class Dette {
        private ?int $idDette;
        private string $dateCreation;
        private float $montantInitial;
        private array $paiements = [];

        private ?Commande $commande = null;

        public function __construct(float $montantInitial = 0.0,string $dateCreation = '', ?int $idDette = null, ?Commande $commande = null) {
            $this->idDette = $idDette;
            $this->setMontantInitial($montantInitial);
            $this->setDateCreation($dateCreation);
            $this->commande = $commande;
        }

        public function getIdDette(): ?int {
            return $this->idDette;
        }

        public function getDateCreation(): string {
            return $this->dateCreation;
        }

        public function getMontantInitial(): float {
            return $this->montantInitial;
        }

        public function getCommande(): ?Commande {
            return $this->commande;
        }

        public function getIdCommande(): ?int {
            return $this->commande !== null ? $this->commande->getIdCommande() : null;
        }

        public function getPaiements(): array {
            return $this->paiements;
        }

        public function setIdDette(int $idDette): void {
            $this->idDette = $idDette;
        }

        public function setDateCreation(string $dateCreation): void {
            if (empty($dateCreation)) {
                $this->dateCreation = date('Y-m-d H:i:s');
                return;
            }
            $this->dateCreation = $dateCreation;
        }

        public function setMontantInitial(float $montantInitial): void {
            if ($montantInitial < 0) {
                throw new Exception("Le montant initial de la dette ne peut pas être négatif.");
            }
            $this->montantInitial = $montantInitial;
        }

        public function setCommande(Commande $commande): void {
            $this->commande = $commande;
        }

        public function setPaiements(Paiement $paiement): void {
            $this->paiements[] = $paiement;
            $paiement->setDette($this);
        }
    }