<?php
    require_once "Fournisseur.php";
    require_once "LigneApprovisionnement.php";

    // CREATE TABLE approvisionnements (
    //     id_approvisionnement SERIAL PRIMARY KEY,
    //     refBL VARCHAR(50) NOT NULL UNIQUE,
    //     qteAchat INTEGER NOT NULL,
    //     qteRecu INTEGER NOT NULL,
    //     montant NUMERIC(10,2) NOT NULL,
    //     fournisseur_id INT REFERENCES fournisseurs(id_fournisseur) ON DELETE SET NULL,

    //     CONSTRAINT chk_positif_valeur CHECK (qteAchat >= 0 AND qteRecu >= 0 AND montant >= 0)
    // );

    class Approvisionnement {
        private ?int $idApprovisionnement;
        private string $refBL;
        private int $qteAchat;
        private int $qteRecu;
        private float $montant;
        private array $ligneApprovisionnements = [];

        private ?Fournisseur $fournisseur = null;

        public function __construct(string $refBL = '',int $qteAchat = 0,int $qteRecu = 0,float $montant = 0.0, ?Fournisseur $fournisseur = null, ?int $idApprovisionnement = null) {
            $this->idApprovisionnement = $idApprovisionnement;
            $this->setRefBL($refBL);
            $this->setQteAchat($qteAchat);
            $this->setQteRecu($qteRecu);
            $this->setMontant($montant);
            $this->fournisseur = $fournisseur;
        }

        public function getIdApprovisionnement(): ?int {
            return $this->idApprovisionnement;
        }

        public function getRefBL(): string {
            return $this->refBL;
        }

        public function getQteAchat(): int {
            return $this->qteAchat;
        }

        public function getQteRecu(): int {
            return $this->qteRecu;
        }

        public function getMontant(): float {
            return $this->montant;
        }

        public function getFournisseur(): ?Fournisseur {
            return $this->fournisseur;
        }

        public function getLigneApprovisionnement(): array{
            return $this->ligneApprovisionnements;
        }

        public function setIdApprovisionnement(int $idApprovisionnement): void {
            $this->idApprovisionnement = $idApprovisionnement;
        }

        private function setRefBL(string $refBL): void {
            if (empty($refBL)) {
                $this->exception("La référence ne peut pas être vide.");
            }
            $this->refBL = $refBL;
        }

        private function setQteAchat(int $qteAchat): void {
            if ($qteAchat < 0) {
                $this->exception("La quantité d'achat ne peut pas être négative.");
            }
            $this->qteAchat = $qteAchat;
        }

        private function setQteRecu(int $qteRecu): void {
            if ($qteRecu < 0) {
                $this->exception("La quantité reçue ne peut pas être négative.");
            }
            $this->qteRecu = $qteRecu;
        }

        private function setMontant(float $montant): void {
            if ($montant < 0) {
                $this->exception("Le montant ne peut pas être négatif.");
            }
            $this->montant = $montant;
        }

        public function setFournisseur(Fournisseur $fournisseur): void {
            $this->fournisseur = $fournisseur;
        }

        public function setAddLigneApprovisionnement(LigneApprovisionnement $ligne): void {
            $this->ligneApprovisionnements[] = $ligne;
            $ligne->setApprovisionnement($this);
        }

        private function exception(string $message): void {
            throw new Exception($message);
        }
    }