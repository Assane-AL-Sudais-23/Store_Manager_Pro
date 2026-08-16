<?php

    // CREATE TABLE paiements (
    //     id_paiement SERIAL PRIMARY KEY,
    //     montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0),
    //     date_paiement TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    //     mode_paiement_id INT NOT NULL REFERENCES modePaiements(id_modePaiement) ON DELETE RESTRICT,
    //     dette_id INT NOT NULL REFERENCES dettes(id_dette) ON DELETE CASCADE
    // );

    namespace Src\Models\Entity;

    use Exception;
    use Src\Models\Entity\Dette;

    class Paiement {
        private ?int $idPaiement;
        private float $montant;
        private string $datePaiement;
        private ?ModePaiement $modePaiement = null;
        private ?Dette $dette = null;

        public function __construct(float $montant = 0.0,string $datePaiement = '',?ModePaiement $modePaiement = null,?Dette $dette = null,?int $idPaiement = null) {
            $this->idPaiement = $idPaiement;
            $this->setMontant($montant);
            $this->setDatePaiement($datePaiement);
            $this->modePaiement = $modePaiement;
            $this->dette = $dette;
        }

        public function getIdPaiement(): ?int {
            return $this->idPaiement;
        }

        public function getMontant(): float {
            return $this->montant;
        }

        public function getDatePaiement(): string {
            return $this->datePaiement;
        }

        public function getModePaiement(): ?ModePaiement {
            return $this->modePaiement;
        }

        public function getDette(): ?Dette {
            return $this->dette;
        }

        public function setIdPaiement(int $idPaiement): void {
            $this->idPaiement = $idPaiement;
        }

        public function setMontant(float $montant): void {
            if ($montant < 0) {
                throw new Exception("Le montant du paiement ne peut pas être négatif.");
            }
            $this->montant = $montant;
        }

        public function setDatePaiement(string $datePaiement): void {
            if (empty(trim($datePaiement))) {
                $this->datePaiement = date('Y-m-d H:i:s');
                return;
            }
            $this->datePaiement = $datePaiement;
        }

        public function setModePaiement(ModePaiement $modePaiement): void {
            $this->modePaiement = $modePaiement;
        }

        public function setDette(Dette $dette): void {
            $this->dette = $dette;
        }
    }